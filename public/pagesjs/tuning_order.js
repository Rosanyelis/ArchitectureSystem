/**
 * app-ecommerce-product-list
 */

"use strict";

const numberFormat2 = new Intl.NumberFormat('es-MX');

// Datatable (jquery)
$(function () {
 
    // Variable declaration for table
    var dt_product_table = $(".datatables-tuning"),
        productAdd = "/afinacion-de-partidas/create";


    // E-commerce Products datatable

    if (dt_product_table.length) {
        var dt_products = dt_product_table.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/afinaciones",
                data: function(d) {
                    d.start = $('#filterdateStart').val();
                    d.end =  $('#filterdateEnd').val();
                    d.status = $('#filterStatus').val();
                }
            },
            dataType: 'json',
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
                // columns according to JSON
                { data: 'id' },
                { data: 'created_at' },
                { data: 'proveedor' },
                { data: 'final_weight' },
                { data: 'total_refined' },
                { data: 'total_amount'},
                { data: 'total_refined_amount'},
                { data: 'total_gram_refined'},
                { data: 'tuning_cost'},
                { data: 'tuning_cost_per_gram'},
                { data: 'gram_coopelation'},
                { data: 'status'},
                { data: 'total'},
                { data: 'total_pagado'},
                { data: 'total_pendiente'},
                { data: 'status_payment'},
                { data: 'actions', orderable: false, searchable: false },
            ],
            columnDefs: [
                // {
                //     // For Responsive
                //     targets: 0,
                //     className: "control",
                //     searchable: false,
                //     orderable: false,
                //     responsivePriority: 1,
                //     render: function (data, type, full, meta) {
                //         return "";
                //     },
                // },
                {
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> #" + full["id"] + "</span>";
                    },
                    responsivePriority: 1,
                },
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + moment(full["created_at"]).format("DD/MM/YYYY") + "</span>";
                    },
                    responsivePriority: 2,
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + full["proveedor"] + "</span>";
                    },
                    responsivePriority: 3,
                },
                {
                    targets: 3,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + full["final_weight"] + "</span>";
                    },
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + full["total_refined"] + "</span>";
                    },
                    responsivePriority: 5,
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + full["total_amount"] + "</span>";
                    },
                    responsivePriority: 6,
                },
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + full["total_refined_amount"] + "</span>";
                    },
                    responsivePriority: 7,
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        if (full["total_gram_refined"] == null) {
                            return "<span class='text-nowrap'> 0 </span>";
                        } else {
                            return "<span class='text-nowrap'> " + full["total_gram_refined"] + "</span>";
                        }
                    },
                    responsivePriority: 8,
                },
                {
                    targets: 8,
                    render: function (data, type, full, meta) {
                        if (full["tuning_cost"] == null) {
                            return "<span class='text-nowrap'> 0 </span>";
                        } else {
                            return "<span class='text-nowrap'> " + full["tuning_cost"] + "</span>";
                        }
                    },
                    responsivePriority: 9,
                },
                {
                    targets: 9,
                    render: function (data, type, full, meta) {
                        if (full["tuning_cost_per_gram"] == null) {
                            return "<span class='text-nowrap'> 0 </span>";
                        } else {
                            return "<span class='text-nowrap'> " + full["tuning_cost_per_gram"] + "</span>";
                        }
                    },
                    responsivePriority: 10,
                },
                {
                    targets: 10,
                    render: function (data, type, full, meta) {
                        if (full["gram_coopelation"] == null) {
                            return "<span class='text-nowrap'> 0 </span>";
                        } else {
                            return "<span class='text-nowrap'> " + full["gram_coopelation"] + "</span>";
                        }
                    },
                    responsivePriority: 11,
                },
                {
                    targets: 11,
                    render: function (data, type, full, meta) {
                        var status = full["status"];
                        if (status == 'Pendiente') {
                            return '<span class="badge bg-warning">' + status + '</span>';
                        } else if (status == 'En Proceso') {
                            return '<span class="badge bg-info">' + status + '</span>';
                        } else if (status == 'Afinado') {
                            return '<span class="badge bg-success">' + status + '</span>';
                        }
                    },
                    responsivePriority: 12,
                },
                {
                    targets: 12,
                    render: function (data, type, full, meta) {
                        if (full["total"] == null) {
                            return "<span class='text-nowrap'> 0 </span>";
                        } else {
                            return "<span class='text-nowrap'> " + full["total"] + "</span>";
                        }
                    },
                    responsivePriority: 13,
                },
                {
                    targets: 13,
                    render: function (data, type, full, meta) {
                        if (full["total_pagado"] == null) {
                            return "<span class='text-nowrap'> 0 </span>";
                        } else {
                            return "<span class='text-nowrap'> " + full["total_pagado"] + "</span>";
                        }
                    },
                    responsivePriority: 14,
                },
                {
                    targets: 14,
                    render: function (data, type, full, meta) {
                        if (full["total_pagado"] == null) {
                            return "<span class='text-nowrap'> 0 </span>";
                        } else {
                            return "<span class='text-nowrap'> " + full["total_pendiente"] + "</span>";
                        }
                    },
                    responsivePriority: 15,
                },
                {
                    targets: 15,
                    render: function (data, type, full, meta) {
                        var status = full["status_payment"];
                        if (status == 'Pendiente') {
                            return '<span class="badge bg-warning">' + status + '</span>';
                        }  else if (status == 'Pagado') {
                            return '<span class="badge bg-success">' + status + '</span>';
                        }
                    },
                    responsivePriority: 16,
                },
                {
                    // Actions
                    targets: 16,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return full["actions"];
                    }
                },
            ],
            lengthMenu: [7, 10, 20, 50, 70, 100], //for length of menu
            // contador de ventas y que si se filtra los contadores se actualicen cuando se filtre
            drawCallback: function(settings) {
                // acceder a la información del json de la tabla
                var data = this.api().data();
                var $totalOroFino = 0;
                var $TotalCostoPorGrAfinado = 0;
                var $TotalCoopelacion = 0;
                var $totalpagado = 0;
                var $total = 0;

                data.each(function(item) {
                    $totalOroFino += parseFloat(item.total_refined);
                    $TotalCostoPorGrAfinado += parseFloat(item.total_refined_amount);
                    $TotalCoopelacion += parseFloat(item.gram_coopelation);
                });

                $totalpagado =  ($TotalCostoPorGrAfinado + $TotalCoopelacion) / $totalOroFino;
                $total = truncarDecimales(parseFloat($totalpagado));
                $('#totalOroFino').html(truncarDecimales($totalOroFino));
                $('#totalCostoPorGrAfinado').html(truncarDecimales($TotalCostoPorGrAfinado));
                $('#totalCoopelacion').html(truncarDecimales($TotalCoopelacion));
                $('#totalpagado').html(truncarDecimales(parseFloat($total)));
            }
        });
        // $(".dt-action-buttons").addClass("pt-0");
        // $(".dt-buttons").addClass("d-flex flex-wrap");
    }
    $('#filterdateEnd').on('change', function() {
        var start = $('#filterdateStart').val();
        var end = $('#filterdateEnd').val();
        if (start > end) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La fecha de inicio no puede ser mayor a la fecha final',
                position: 'top-center',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                    },
                buttonsStyling: false
            });
            return false;
        }
        if (start == '' || end == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debe seleccionar ambas fechas',
                position: 'top-center',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                    },
                buttonsStyling: false
            });

            $('#filterdateStart').val('');
            $('#filterdateEnd').val('');
        }
        dt_products.ajax.reload();
    });
    $('#filterStatus').on('change', function() {
        dt_products.ajax.reload();
    })
    $('#reset_filter').on('click', function () {
        $('#filterStatus').val('');
        $('#filterdateStart').val('');
        $('#filterdateEnd').val('');
        dt_products.ajax.reload();
    });
});
function truncarDecimales(numero, decimales = 2) {
    if (typeof numero !== 'number' || typeof decimales !== 'number') {
        throw new Error('Ambos parámetros deben ser números');
    }

    const factor = Math.pow(10, decimales);
    const resultado = Math.floor(numero * factor) / factor;
    return resultado.toFixed(decimales).replace(',', '.');
}
function payOrder(id, amount) {
    $('#modalpreorden_id').html('');
    $('#amount').val('');
    $('#modalamount').text(numberFormat2.format(amount));
    $('#modalpreorden_id').html(id);
    $('#order_id').val(id);
    $('#amount').val(amount);
    $('#PayOrderModal').modal('show');
}