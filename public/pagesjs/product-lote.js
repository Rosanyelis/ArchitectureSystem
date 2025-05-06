/**
 * app-ecommerce-product-list
 */

"use strict";

const numberFormat = new Intl.NumberFormat("es-MX");
var partidas = [];
var i = 1;
// Datatable (jquery)
$(function () {
    // Variable declaration for table
    var dt_product_table = $(".datatables-product"),
        productAdd = "/pos";

    // E-commerce Products datatable
    if (dt_product_table.length) {
        var dt_products = dt_product_table.DataTable({
            ajax: {
                url: "/productos-por-lote",
                data: function(d) {
                    d.status = $('#status').val();
                }
            },
            columns: [
                {data: 'id'},
                {data: 'created_at'},
                {data: 'material_id'},
                {data: 'type_product_id'},
                {data: 'order_id'},
                {data: 'weight'},
                {data: 'status'},
                {data: 'actions', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: "control",
                    searchable: false,
                    orderable: false,
                    responsivePriority: 1,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    targets: 1,
                    responsivePriority: 2,
                    render: function (data, type, full, meta) {
                        var $fecha = moment(full["created_at"]).format("DD/MM/YYYY");
                        return ("<span class='text-nowrap'>" + $fecha + "</span>");
                    },
                },
                {
                    targets: 2,
                    responsivePriority: 3,
                    render: function (data, type, full, meta) {
                        return ("<span class='text-nowrap'>" + full["material"]["name"] + "</span>");
                    },
                },
                {
                    targets: 3,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        return ("<span class='text-nowrap'>" + full["type_product"]["name"] + "</span>");
                    },
                },
                {
                    targets: 4,
                    responsivePriority: 5,
                    render: function (data, type, full, meta) {
                        if (full["order_id"] == null) {
                            return ("<span class='text-nowrap'>"+ full["tuning_order_id"]+"</span>");
                        } else {
                            return ("<span class='text-nowrap'>" + full["order_id"] + "</span>");
                        }
                    },
                },
                {
                    targets: 5,
                    responsivePriority: 6,
                    render: function (data, type, full, meta) {
                        return ("<span class='text-nowrap'> Gr. " + full["weight"] + "</span>");
                    },
                },
                {
                    targets: 6,
                    responsivePriority: 10,
                    render: function (data, type, full, meta) {
                        if (full["status"] == 'Procesado') {
                            return ("<span class='badge bg-success text-uppercase'>Ingresado a Inventario</span>");
                        } else if (full["status"] == 'Por Vender') {
                            return ("<span class='badge bg-warning text-uppercase'>Sin Procesar</span>");
                        }
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
            // Buttons with Dropdown
            buttons: [
                {
                    extend: "collection",
                    className:
                        "btn btn-outline-success dropdown-toggle me-4 waves-effect waves-light",
                    text: '<i class="ri-upload-2-line ri-16px me-2"></i><span class="d-none d-sm-inline-block">Exportar </span>',
                    buttons: [
                        {
                            extend: "pdf",
                            text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                            className: "dropdown-item",
                            action: function (e, dt, button, config) {
                                // var user = $("#users").val();
                                // var day = $("#filterday").val();

                                // window.open("/ventas/generar-pdf?user=" + user + "&day=" + day, "_blank");
                            },
                        }
                        // {
                        //     extend: "pdf",
                        //     text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                        //     className: "dropdown-item",
                        //     action: function (e, dt, button, config) {
                        //         window.open("/productos/todos-los-productos", "_blank");
                        //     },
                        // },
                    ],
                },
                // {
                //     text: '<i class="ri-add-line ri-16px me-0 me-sm-2 align-baseline"></i><span class="d-none d-sm-inline-block">Nueva Venta</span>',
                //     className:
                //         "add-new btn btn-primary waves-effect waves-light",
                //     action: function () {
                //         window.location.href = productAdd;
                //     },
                // },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Detalles de Producto - " + data["name"];
                        },
                    }),
                    type: "column",
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
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
                var api = this.api();
                // contar la cantidad de datos que tienen el tipo de material Oro
                var countOro = 0;
                var countPlatino = 0;
                var countPlata = 0;
                var countPaladio = 0;
                api
                    .column(2)
                    .data()
                    .each(function (value) {
                        if (value == 1) {
                            countOro++;
                        }
                        if (value == 2) {
                            countPlata++;
                        }
                        if (value == 3) {
                            countPaladio++;
                        }
                        if (value == 4) {
                            countPlatino++;
                        }
                    });

                // actualizar el contador en el html
                $("#countOro").text(countOro);
                $("#countPlata").text(countPlata);
                $("#countPlatino").text(countPlatino);
                $("#countPaladio").text(countPaladio);
            }
        });
        $(".dt-action-buttons").addClass("pt-0");
        $(".dt-buttons").addClass("d-flex flex-wrap");
    }

    $('#status').on('change', function() {
        dt_products.ajax.reload();
    })
    $('#reset_filter').on('click', function () {
        $('#status').val('');
        dt_products.ajax.reload();
    });

    $('#costo_gramos').on('change', function () {
        var gramos = parseFloat($('#gramos').val());
        var costo_gramos = parseFloat($('#costo_gramos').val());
        var total_costo_gramos = gramos * costo_gramos;
        $('#total_costo_gramos').val(total_costo_gramos);
    });


    $('#addMaterial').on('click', function () {
        var material_id = $('#material_id').val(),
            type_product_id = $('#type_product_id').val(),
            gramos = $('#gramos').val(),
            costo_gramos = $('#costo_gramos').val(),
            total_costo_gramos = $('#total_costo_gramos').val();

            if (material_id == '' || type_product_id == '' ||
                gramos == '' || costo_gramos == '' ||
                total_costo_gramos == '')
            {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No puede dejar campos vacios al intentar agregar un material',
                    position: 'top-center',
                    customClass: {
                        confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                    buttonsStyling: false
                });

                return false;
            }


        partidas.push({
            'id': i,
            'material': material_id,
            'typeproduct': type_product_id,
            'gramos': gramos,
            'costo_gramos': costo_gramos,
            'total_costo_gramos': total_costo_gramos
        });


        $('#tableMaterial tbody').append(
            `<tr id="row-`+i+`">
                <td>`+material_id+`</td>
                <td>`+type_product_id+`</td>
                <td>`+gramos+`</td>
                <td>`+costo_gramos+`</td>
                <td>`+total_costo_gramos+`</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm"
                        id="delete_product" data-code="`+i+`">
                        <i class="ri-delete-bin-fill"></i>
                    </button>
                </td>
            </tr>`);

        i++;

        $('#material_id').val('').trigger('change');
        $('#type_product_id').val('').trigger('change');
        $('#type_partida').val('').trigger('change');
        $('#gramis').val('');
        $('#costo_gramos').val('');
        $('#total_costo_gramos').val('');
    });

    $('#saveOrder').on('click', function() {
        if (partidas.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No hay Productos para guardar',
                position: 'top-center',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                    },
                buttonsStyling: false
            });

            return false;
        }

        $('#materiales_array').val(JSON.stringify(partidas));

        $('#formInventory').submit();

        $('#saveOrder').prop('disabled', true);
        $('#saveOrder').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
    });
});
