
"use strict";

const numberFormat = new Intl.NumberFormat("es-MX");
const id = $("#idCuenta").val();
// Datatable (jquery)
$(function () {
    
    // Variable declaration for table
    var dt_product_table = $(".datatables-history");        

    // E-commerce Products datatable
    if (dt_product_table.length) {
        var dt_products = dt_product_table.DataTable({
            processing: true,
            serverSide: true,
            ajax: "/cuentas/" + id + "/show",
            type: "POST",
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            columns: [
                {data: ''},
                {data: 'created_at'},
                {data: 'description'},
                {data: 'amount'},
                {data: 'amount'},
                {data: 'before_balance'},
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
                        return ("<span class='text-nowrap'>" + moment(full["created_at"]).format("DD/MM/YYYY") + "</span>");
                    },
                },
                {
                    targets: 2,
                    responsivePriority: 3,
                    render: function (data, type, full, meta) {
                        return ("<span class='text-nowrap'>" + full["description"] + "</span>");
                    },
                },
                {
                    targets: 3,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        if (full["type"] == 'Ingreso') {
                            return ("<span class='text-nowrap'>" + numberFormat.format(full["amount"] ?? 0) + "</span>");    
                        } else {
                            return ("<span class='text-nowrap'> - </span>");
                        }
                    },
                },
                {
                    targets: 4,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        if (full["type"] == 'Egreso') {
                            return ("<span class='text-nowrap'>" + numberFormat.format(full["amount"] ?? 0) + "</span>");    
                        } else {
                            return ("<span class='text-nowrap'> - </span>");
                        }
                    },
                },
                {
                    targets: 5,
                    responsivePriority: 5,
                    render: function (data, type, full, meta) {
                        return ("<span class='text-nowrap'>" + numberFormat.format(full["before_balance"] ?? 0) + "</span>");
                    },
                },                
            ],
            drawCallback: function () {
                var data = this.api().data();
                var Ingresos = 0;
                var Egresos = 0;
                data.each(function (item) {
                    if (item.type == 'Ingreso') {
                        Ingresos += parseFloat(item.amount);
                    }
                    if (item.type == 'Egreso') {
                        Egresos += parseFloat(item.amount);
                    }
                });
                $("#totalIngresos").text(numberFormat.format(Ingresos));
                $("#totalEgresos").text(numberFormat.format(Egresos));
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
                "/cuentas/"+id+"/destroy";
        }
    })
}