/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables');
    const numberFormat2 = new Intl.NumberFormat('es-MX');
    const SelectedItems = [];
$(function () {


    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: "/ordenes",
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
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'cliente', name: 'cliente'},
                {data: 'partidas', name: 'partidas'},
                {data: 'fundidos', name: 'fundidos'},
                {data: 'aceptadas', name: 'aceptadas'},
                {data: 'rechazadas', name: 'rechazadas'},
                {data: 'status', name: 'status'},
                {data: 'total_pagar', name: 'total_pagar'},
                {data: 'total_pagado', name: 'total_pagado'},
                {data: 'total_pendiente', name: 'total_pendiente'},
                {data: 'status_payment', name: 'status_payment'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [1],
                    render: function(data) {
                        return moment(data).format('DD/MM/YYYY');
                    }
                },
                {
                    targets: [7],
                    render: function(data) {
                        if (data == 'Pendiente') {
                            return '<span class="badge bg-warning">Pendiente</span>';
                        }
                        if (data == 'En proceso') {
                            return '<span class="badge bg-primary">En Proceso</span>';
                        }
                        if (data == 'Listo para la Compra') {
                            return '<span class="badge bg-success">Listo</span>';
                        }
                    }
                },
                {
                    targets: [8, 9, 10],
                    render: function(data) {
                        return '$ ' + numberFormat2.format(data);
                    }
                },
                {
                    targets: [11],
                    render: function(data, type, row) {
                        if (data == 'Pendiente') {
                            return '<span class="badge bg-warning">Pendiente</span>';
                        }
                        if (data == 'Pagado') {
                            return '<span class="badge bg-success">Pagado</span>';
                        }
                    }
                }
            ]

        });
    }
});

function acceptOrder(id) {
    $.ajax({
        url: '/ordenes/' + id + '/items-de-orden',
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (data) {
            // Limpiar datos previos
            $('#preorden_id').text('');
            $('#order_items tbody').empty();
            $('#preorden_id').text(id);
            $('#acepted_order_id').val(id);
            $('#rejected_order_id').val(id);
            $('#acepted_rejected').empty();

            // Encabezado con checkbox de "Seleccionar Todo"
            $('#order_items thead').html(`
                <tr class="text-center align-middle">
                    <th>
                        <div class="form-check font-size-16">
                            <input class="form-check-input" type="checkbox" id="check-all">
                            <label class="form-check-label" for="check-all"></label>
                        </div>
                    </th>
                    <th>Material</th>
                    <th>Tipo</th>
                    <th>Peso Final</th>
                    <th>Total</th>
                    <th>Estatus Preorden</th>
                    <th id="acepted_rejected"></th>
                </tr>
            `);

            // Botones Aceptar/Rechazar Todas
            $('#order_items thead #acepted_rejected').append(`
                <div class="d-flex align-items-center">
                    <button id="accept-all" class="btn btn-xs btn-success py-1" disabled>
                        <span class="tf-icons ri-check-double-line ri-16px me-2"></span>Aceptar
                    </button>
                    &nbsp;&nbsp;/&nbsp;&nbsp;
                    <button id="reject-all" class="btn btn-xs btn-danger py-1" disabled>
                        <span class="tf-icons ri-close-line ri-16px me-2"></span>Rechazar
                    </button>
                </div>
            `);

            // Variable para acumular el total de partidas aceptadas
            let acceptedTotal = 0;

            // Renderizar los elementos
            data.forEach(value => {
                const isAccepted = value.status_final === 'Aceptada';
                const isPending = value.status_final === 'Pendiente';

                // Si ya está aceptada, sumar el monto al total
                if (isAccepted) {
                    acceptedTotal += parseFloat(value.total_amount || 0);
                }

                const checkbox = isPending
                    ? `<div class="form-check font-size-16">
                            <input class="form-check-input item-checkbox" type="checkbox" id="check${value.id}" value="${value.id}" data-amount="${value.total_amount}">
                            <label class="form-check-label" for="check${value.id}"></label>
                        </div>`
                    : '';

                const btn = isPending
                    ? `
                        <button class="btn btn-success btn-sm py-1 accept-item" data-id="${value.id}" data-amount="${value.total_amount}" title="Aceptar Partida">
                            <i class="ri-check-line ri-20px"></i>
                        </button>
                        <button class="btn btn-danger btn-sm py-1 reject-item" data-id="${value.id}" data-amount="${value.total_amount}" title="Rechazar Partida">
                            <i class="ri-close-line ri-20px"></i>
                        </button>`
                    : value.status_final;

                $('#order_items tbody').append(`
                    <tr id="row${value.id}">
                        <td>${checkbox}</td>
                        <td>${value.material.name}</td>
                        <td>${value.type_product.name}</td>
                        <td>${value.final_weight || 0}</td>
                        <td>$ ${numberFormat2.format(value.total_amount)}</td>
                        <td>${value.status}</td>
                        <td class="status-column">${btn}</td>
                    </tr>
                `);
            });

            // Actualizar el total inicial en el pie de tabla
            $('#total_acepted').text('$ ' + numberFormat2.format(acceptedTotal));

            setupSelectionHandlers();
            $('#OrderModal').modal('show');
        }
    });
}

function setupSelectionHandlers() {
    const checkAll = $('#check-all');
    const itemCheckboxes = $('.item-checkbox');
    const acceptAll = $('#accept-all');
    const rejectAll = $('#reject-all');

    // Seleccionar/Deseleccionar Todos
    checkAll.on('change', function () {
        const isChecked = $(this).is(':checked');
        itemCheckboxes.prop('checked', isChecked);
        toggleActionButtons();
        updateFooterTotal();
    });

    // Seleccionar/Deseleccionar Individual
    itemCheckboxes.on('change', function () {
        const allChecked = itemCheckboxes.length === $('.item-checkbox:checked').length;
        checkAll.prop('checked', allChecked);
        toggleActionButtons();
        updateFooterTotal();
    });

    // Habilitar/Deshabilitar Botones
    function toggleActionButtons() {
        const hasSelection = $('.item-checkbox:checked').length > 0;
        acceptAll.prop('disabled', !hasSelection);
        rejectAll.prop('disabled', !hasSelection);
    }

    // Aceptar/Rechazar Individual
    $('.accept-item').on('click', function () {
        const id = $(this).data('id');
        processSingleAction('/ordenes/aceptar-partida', id, 'Aceptada');
    });

    $('.reject-item').on('click', function () {
        const id = $(this).data('id');
        processSingleAction('/ordenes/rechazar-partida', id, 'Rechazada');
    });

    // Aceptar/Rechazar Todas
    acceptAll.on('click', function () {
        processBulkAction('/ordenes/aceptar-todas-partidas', getSelectedIds(), 'Aceptada');
    });

    rejectAll.on('click', function () {
        processBulkAction('/ordenes/rechazar-todas-partidas', getSelectedIds(), 'Rechazada');
    });
}

function updateFooterTotal() {
    let total = 0;
    $('.item-checkbox:checked').each(function () {
        total += parseFloat($(this).data('amount'));
    });
    $('#total_acepted').text('$ ' + numberFormat2.format(total));
}


function getSelectedIds() {
    return $('.item-checkbox:checked').map(function () {
        return $(this).val();
    }).get();
}

function processSingleAction(url, id, newStatus) {
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
        },
        success: function (data) {
            // Actualizar estatus en la fila correspondiente
            const row = $(`#row${id}`);
            const amount = parseFloat(row.find('.item-checkbox').data('amount')) || 0;

            row.find('.status-column').text(newStatus);
            row.find('.item-checkbox').remove(); // Desactivar el checkbox
            row.find('.accept-item, .reject-item').remove(); // Eliminar los botones

            // Si la partida fue aceptada, actualizar el total del footer
            if (newStatus === 'Aceptada') {
                const currentTotal = parseFloat($('#total_acepted').text().replace(/[^0-9.-]+/g, '')) || 0;
                const newTotal = currentTotal + amount;
                $('#total_acepted').text('$ ' + numberFormat2.format(newTotal));

                // updateFooterTotal();
            }

            // Opcional: Mostrar notificación de éxito
            Swal.fire({
                icon: 'success',
                title: `Partida ${newStatus.toLowerCase()} correctamente`,
                customClass: { confirmButton: 'btn btn-primary waves-effect waves-light' },
                buttonsStyling: false
            });

            dt_ajax_table.DataTable().ajax.reload();
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error al procesar la solicitud',
                customClass: { confirmButton: 'btn btn-primary waves-effect waves-light' },
                buttonsStyling: false
            });
        }
    });
}


function processBulkAction(url, ids, newStatus) {
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            ids: ids
        },
        success: function () {
            // Actualizar estatus en todas las filas seleccionadas
            ids.forEach(id => {
                const row = $(`#row${id}`);
                row.find('.status-column').text(newStatus);
                row.find('.item-checkbox').remove(); // Desactivar el checkbox
                row.find('.accept-item, .reject-item').remove(); // Eliminar los botones
            });
            updateFooterTotal();

            dt_ajax_table.DataTable().ajax.reload();
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error al procesar la solicitud',
                customClass: { confirmButton: 'btn btn-primary waves-effect waves-light' },
                buttonsStyling: false
            });

            dt_ajax_table.DataTable().ajax.reload();
        }
    });
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

