/**
 * app-ecommerce-product-list
 */

"use strict";

const baseUrl = document.querySelector("html").getAttribute("data-base-url");
const assetsPath = document
    .querySelector("html")
    .getAttribute("data-assets-path");
const numberFormat = new Intl.NumberFormat("es-MX");
const numberFormat2 = new Intl.NumberFormat("es-MX");

// Datatable (jquery)
$(function () {

    // Variable declaration for table
    var dt_product_table = $(".datatables-sales"),
        productAdd = "/pos";

    if (dt_product_table.length) {
        var dt_products = dt_product_table.DataTable({
            ajax: {
                url: baseUrl + "/ventas",
                data: function(d) {
                    d.day = $('#filterday').val();
                    d.user_id = $('#users').val();
                }
            },
            columns: [
                // columns according to JSON
                { data: "id" },
                { data: "id" },
                { data: "cliente" },
                { data: "sales.created_at" },
                { data: "payment_method" },
                { data: "total_amount" },
                { data: "total_pagado" },
                { data: "total_pendiente" },
                { data: "user_name" },
                { data: "actions" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: "control",
                    searchable: false,
                    orderable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var $id = full["id"];
                        return "<a href='javascript:void();'> #" + $id + "</a>";
                    },
                },
                {
                    // Product name and product_brand
                    targets: 2,
                    responsivePriority: 1,
                    render: function (data, type, full, meta) {
                        var $name = full['cliente'];

                         // For Avatar badge
                        var $output;
                        var stateNum = Math.floor(Math.random() * 6);
                        var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                        var $state = states[stateNum],
                            $name = full['cliente'],
                            $initials = $name.match(/\b\w/g) || [];
                        $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                        $output = '<span class="avatar-initial rounded-circle bg-' + $state + '">' + $initials + '</span>';

                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-start align-items-center user-name">' +
                                '<div class="avatar-wrapper">' +
                                    '<div class="avatar avatar-sm me-3">' + $output +'</div>' +
                                '</div>' +
                                '<div class="d-flex flex-column">' +
                                    '<a href="javascript:void(0);" class="text-truncate text-heading"><span class="fw-medium">' +
                                        $name +
                                        '</span></a>' +
                                '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
                {
                    targets: 3,
                    responsivePriority: 5,
                    render: function (data, type, full, meta) {
                        var $fecha = moment(full["created_at"]).format("DD/MM/YYYY");
                        return ("<span class='text-nowrap'>" + $fecha + "</span>");
                    },
                },
                {
                    // Métodos de pago: convertir en lista
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var paymentMethods = full["payment_method"] || ""; // Obtener los métodos de pago
                        if (!paymentMethods.trim()) return "<em>Sin métodos de pago</em>"; // Manejo de datos vacíos
                        // Convertir a array y mapear para generar lista
                        var methodsArray = paymentMethods.split(",");
                        var methodsList = methodsArray
                            .map(function (method) {
                                return `
                                    <h6 class="mb-0 w-px-100 d-flex align-items-center text-secondary">
                                        <i class="ri-circle-fill ri-10px me-1"></i>${method.trim()}
                                    </h6>`;
                            })
                            .join(""); // Unir el HTML generado
                        return `<div>${methodsList}</div>`; // Envolver en un contenedor
                    },
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        return "<span>" + numberFormat.format(full["total_amount"]) + "</span>";
                    },
                },
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        return "<span>" + numberFormat.format(full["total_pagado"]) + "</span>";
                    },
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        return "<span>" + numberFormat.format(full["total_pendiente"]) + "</span>";
                    },
                },
                {
                    targets: 8,
                    render: function (data, type, full, meta) {
                        var $vendedor = full["user_name"];
                        return "<span>" + $vendedor + "</span>";
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
                                var user = $("#users").val();
                                var day = $("#filterday").val();

                                window.open("/ventas/generar-pdf?user=" + user + "&day=" + day, "_blank");
                            },
                        }
                    ],
                },
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Detalles de Venta - " + data["name"];
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
                var data = this.api().data();
                var ventas = data.length;
                $('#total_sales').html(ventas);
                // tomar un solo registro de la data
                var $total = 0;
                data.each(function(item) {
                    $total += parseFloat(item.total_amount);
                });

                $('#total_amount').html(numberFormat.format($total));
            }
        });
        $(".dt-action-buttons").addClass("pt-0");
        $(".dt-buttons").addClass("d-flex flex-wrap");
    }

    $('#filterday').on('change', function() {
        dt_products.ajax.reload();
    });
    $('#users').on('change', function() {
        dt_products.ajax.reload();
    })
    $('#reset_filter').on('click', function () {
        $('#filterday').val('');
        $('#users').val('');
        dt_products.ajax.reload();
    });
});
function payOrder(id, amount) {
    $('#modalpreorden_id').html('');
    $('#amount').val('');
    $('#modalamount').text(numberFormat2.format(amount));
    $('#modalpreorden_id').html(id);
    $('#order_id').val(id);
    $('#amount').val(amount);
    $('#PayOrderModal').modal('show');
}