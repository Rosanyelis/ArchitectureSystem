/**
 * Módulo de Listado de Presupuestos
 * Maneja la visualización y funcionalidades de la tabla de presupuestos
 */

'use strict';

const numberFormat = new Intl.NumberFormat('es-AR', {
    style: 'currency',
    currency: 'ARS',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
});

const BudgetListModule = {
    // Inicialización del módulo
    init: function() {
        this.initDataTable();
        this.bindEvents();
    },

    // Inicializar DataTable
    initDataTable: function() {
        this.table = $('#budgetsTable').DataTable({
            processing: true,
            serverSide: true,
            url: '/presupuestos',
            type: 'POST',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'cliente', name: 'cliente' },
                { data: 'fecha', name: 'fecha' },
                { data: 'total_formatted', name: 'total_formatted' },
                { data: 'moneda', name: 'moneda' },
                { data: 'abonado', name: 'abonado' },
                { data: 'pendiente', name: 'pendiente' },
                { data: 'estatus', name: 'estatus' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
                { 
                    targets: [7], 
                    render: function (data, type, full, meta) {
                        if (data == 'Pendiente') {
                            return  `
                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">Pendiente</button>
                            <ul class="dropdown-menu" style="">
                                <li><h6 class="dropdown-header text-uppercase">Cambiar a </h6></li>
                                <li><a class="dropdown-item waves-effect" href="/presupuestos/${full.id}/updateStatus?status=Aprobado">Aprobado</a></li>
                                <li><a class="dropdown-item waves-effect" href="/presupuestos/${full.id}/updateStatus?status=Rechazado">Rechazado</a></li>
                            </ul>
                            `;
                        } else if (data == 'Aprobado') {
                            return "<span class='badge bg-success'>Aprobado</span>";
                        } else {
                            return "<span class='badge bg-danger'>Rechazado</span>";
                        }
                    }
                }
            ],
            order: [[2, 'desc']], // Ordenar por fecha descendente por defecto
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            responsive: true,
            pageLength: 10,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });
    },

    // Enlazar eventos
    bindEvents: function() {
        // Eliminar presupuesto
        $(document).on('click', '.btn-delete', (e) => {
            e.preventDefault();
            const id = $(e.currentTarget).data('id');
            this.deleteBudget(id);
        });

        // Ver presupuesto
        $(document).on('click', '.btn-view', (e) => {
            e.preventDefault();
            const id = $(e.currentTarget).data('id');
            this.viewBudget(id);
        });

        // Abrir modal de pago
        $(document).on('click', '.payBudget', (e) => {
            e.preventDefault();
            const id = $(e.currentTarget).data('id');
            const amount = $(e.currentTarget).data('amount');
            const currency = $(e.currentTarget).data('currency');
            this.openPaymentModal(id, amount, currency);
        });

        // Guardar pago
        $(document).on('click', '#savePayment', (e) => {
            e.preventDefault();
            this.savePayment($(e.currentTarget).data('id'));
        });
    },

    // Eliminar presupuesto
    deleteBudget: function(id) {
        Swal.fire({
            title: '¿Está seguro de eliminar este presupuesto?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-danger me-3',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/presupuestos/${id}/destroy`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => {
                        this.showAlert('Éxito', 'Presupuesto eliminado correctamente', 'success');
                        this.table.ajax.reload();
                    },
                    error: (xhr) => {
                        this.showAlert('Error', 'No se pudo eliminar el presupuesto', 'error');
                    }
                });
            }
        });
    },

    // Ver presupuesto
    viewBudget: function(id) {
        $.ajax({
            url: `/presupuestos/${id}/show`,
            type: 'GET',
            success: (response) => {
                console.log(response);
                let cliente = response.budget.customer.nombre + ' ' + response.budget.customer.apellido;
                let fecha = moment(response.budget.created_at).format('DD/MM/YYYY');
                let moneda = response.budget.currency.name + ' ' + response.budget.currency.abbreviation;
                // Cargar información básica
                $('#cliente-nombre').text(cliente);
                $('#fecha-presupuesto').text(fecha);
                $('#tipo-moneda').text(moneda);

                // Limpiar y cargar la tabla de presupuesto
                const tbody = $('#tablePresupuesto tbody');
                tbody.empty();
                // Limpiar y cargar la tabla de pagos
                const tbodyPagos = $('#tablePagos tbody');
                tbodyPagos.empty();
                // Cargar los items del presupuesto
                response.budget.items.forEach(item => {
                    tbody.append(`
                        <tr>
                            <td>${item.type}</td>
                            <td>${numberFormat.format(item.amount) }</td>
                        </tr>
                    `);
                });
                // Cargar los pagos del presupuesto
                console.log(response.budget.payments);
                response.budget.payments.forEach(pago => {
                    tbodyPagos.append(`
                        <tr>
                            <td>${moment(pago.payment_date).format('DD/MM/YYYY')}</td>
                            <td>${pago.payment_method.name}</td>
                            <td>${pago.dollar_rate.rate}</td>
                            <td>${numberFormat.format(pago.amount)}</td>
                            <td>${numberFormat.format(pago.amount_pesos)}</td>
                            <td>${pago.concept}</td>
                            <td>
                                <a class="btn btn-icon btn-sm waves-effect waves-light" 
                                href="/presupuestos/${response.budget.id}/payments/${pago.id}/show" target="_blank">
                                    <i class="ri-printer-fill"></i>
                                </a>
                            </td>
                        </tr>
                    `);
                });
                // Actualizar el total
                $('#total').text(numberFormat.format(response.budget.total));

                // Mostrar el modal
                $('#ViewBudgetModal').modal('show');
            },
            error: (xhr) => {
                this.showAlert('Error', 'No se pudo cargar la información del presupuesto', 'error');
            }
        });
    },

    // Abrir modal de pago
    openPaymentModal: function(budgetId, amount, currency) {
        // Limpiar el formulario

        $('#paymentForm')[0].reset();
        $('.budget_id').val(budgetId);
        $('.pendingAmount').text(numberFormat.format(amount));
        $('.currencyBudget').text(currency);
        $('#savePayment').data('id', budgetId);
        
        // Mostrar el modal
        $('#PaymentModal').modal('show');
    },

    // Guardar pago
    savePayment: function(budgetId) {
        // Validar campos obligatorios
        const requiredFields = {
            'payment_method': 'Método de pago',
            'currency': 'Moneda',
            'amount': 'Monto',
            'amount_ars': 'Monto en pesos',
            'dollar_rate_id': 'Cotización del dólar',
            'concept': 'Concepto'
        };

        let isValid = true;
        let errorMessage = '';

        // Validar cada campo requerido
        for (const [field, label] of Object.entries(requiredFields)) {
            const value = $(`#${field}`).val();
            if (!value || value.trim() === '') {
                isValid = false;
                errorMessage = `El campo ${label} es obligatorio`;
                $(`#${field}`).addClass('is-invalid');
                break;
            } else {
                $(`#${field}`).removeClass('is-invalid');
            }
        }

        // Validar que el monto sea mayor a 0
        const amount = parseFloat($('#amount').val());
        if (amount <= 0) {
            isValid = false;
            errorMessage = 'El monto debe ser mayor a 0';
            $('#amount').addClass('is-invalid');
        }

        if (!isValid) {
            this.showAlert('Error de validación', errorMessage, 'error');
            return;
        }

        // Preparar datos del formulario
        const formData = {
            budget_id: budgetId,
            payment_method: $('#payment_method').val(),
            currency_id: $('#currency').val(),
            amount: $('#amount').val(),
            amount_ars: $('#amount_ars').val(),
            dollar_rate_id: $('#dollar_rate_id').val(),
            concept: $('#concept').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        // Mostrar indicador de carga
        $('#savePayment').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...');

        $.ajax({
            url: `/presupuestos/${budgetId}/processPayment`,
            type: 'POST',
            data: formData,
            success: (response) => {
                this.showAlert('Éxito', 'Pago registrado correctamente', 'success');
                $('#PaymentModal').modal('hide');
                this.table.ajax.reload();
            },
            error: (xhr) => {
                let errorMessage = 'No se pudo registrar el pago';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                this.showAlert('Error', errorMessage, 'error');
            },
            complete: () => {
                // Restaurar botón
                $('#savePayment').prop('disabled', false).text('Guardar Pago');
            }
        });
    },

    // Mostrar alertas
    showAlert: function(title, text, icon) {
        Swal.fire({
            title,
            text,
            icon,
            position: 'top-center',
            customClass: {
                confirmButton: 'btn btn-primary waves-effect waves-light'
            },
            buttonsStyling: false
        });
    }
};

// Inicializar módulo al cargar la página
$(document).ready(function() {
    BudgetListModule.init();
}); 