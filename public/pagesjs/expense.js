
"use strict";
const numberFormat = new Intl.NumberFormat("es-MX");

$(function () {

    var dt_product_table = $(".datatables-gastos"),
        productAdd = "/gastos/create";
    if (dt_product_table.length) {
        var dt_products = dt_product_table.DataTable({
            processing: true,
            serverSide: true,
            ajax: "/gastos",
            type: "POST",
            columns: [
                {data: ''},
                {data: 'created_at'},
                {data: 'type.name'},
                {data: 'amount'},
                {data: 'observation'},
                {data: 'actions'},
            ],
            columnDefs: [
                {
                    targets: 0,
                    className: "control",
                    searchable: false,
                    orderable: false,
                    responsivePriority: 1,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    targets: 1,
                    responsivePriority: 2,
                    render: function (data, type, full, meta) {
                        return ("<span class='text-nowrap'>" + moment(full["created_at"], "YYYY-MM-DD").format("DD/MM/YYYY") + "</span>");
                    },
                },
                {
                    targets: 2,
                    responsivePriority: 3,
                    render: function (data, type, full, meta) {
                        return ("<span class='text-nowrap'>" + full["type"]["name"] + "</span>");
                    },
                },
                {
                    targets: 3,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        return ("<span class='text-nowrap'>" + numberFormat.format(full["amount"] ?? 0) + "</span>");
                    },
                },
                {
                    targets: 4,
                    responsivePriority: 5,
                    render: function (data, type, full, meta) {
                        return ("<span class='text-nowrap'>" + full["observation"] + "</span>");
                    },
                },
            ],
            dom:
                '<"card-header d-flex border-top rounded-0 flex-wrap pb-md-0 pt-0"' +
                '<"me-5 ms-n2"f>' +
                '<"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center gap-4"lB>>' +
                ">t" +
                '<"row mx-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            lengthMenu: [7, 10, 20, 50, 70, 100], //for length of menu
            language: {
                sLengthMenu: "_MENU_",
                search: "",
                searchPlaceholder: "Buscar",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>',
                },
            },
            buttons: [
                {
                    text: '<i class="ri-add-line ri-16px me-0 me-sm-2 align-baseline"></i><span class="d-none d-sm-inline-block"> Nuevo Gasto</span>',
                    className:
                        "add-new btn btn-primary waves-effect waves-light btn-sm",
                    action: function () {
                        window.location.href = productAdd;
                    },
                },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Detalles de Gasto - " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            // eliminar la etiqueta <br/> del title
                            col.title = col.title.replace(/<br>/g, " ");
                            return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                      col.rowIndex +
                                      '" data-dt-column="' +
                                      col.columnIndex +
                                      '">' +
                                      "<td>" +
                                      col.title +
                                      ":" +
                                      "</td> " +
                                      "<td>" +
                                      col.data +
                                      "</td>" +
                                      "</tr>"
                                : "";
                        }).join("");

                        return data
                            ? $('<table class="table"/><tbody />').append(data)
                            : false;
                    },
                },
            },
            // contador de ventas y que si se filtra los contadores se actualicen cuando se filtre
            drawCallback: function(settings) {
                // acceder a la información del json de la tabla
                var data = this.api().data();
                // Sumar la cantidad de balance actual que tienen todas las cuentas diferentes al nombre Dolares
                var count = data.length;
                var TotalExpense = 0;
                data.each(function (item) {
                    TotalExpense += parseFloat(item.amount);
                });
                // actualizar el contador en el html
                $("#expense").text(numberFormat.format(count));
                $("#totalExpense").text(numberFormat.format(TotalExpense));
            }
        });
        $(".dt-action-buttons").addClass("pt-0");
        $(".dt-buttons").addClass("d-flex flex-wrap");
    }
});
function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar este Registro?',
        text: "No podra recuperar la información!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
            cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
                "/gastos/"+id+"/destroy";
        }
    })
}