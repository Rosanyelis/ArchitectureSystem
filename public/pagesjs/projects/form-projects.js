/**
 * Módulo de Formulario de Proyectos
 * Maneja la carga y selección de clientes y proyectos
 */

'use strict';

const numberFormat = new Intl.NumberFormat('es-AR', {
    style: 'currency',
    currency: 'ARS',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
});

const ProjectFormModule = {
    // Inicialización del módulo
    init: function() {
        this.loadClients();
        this.bindEvents();
    },

    // Cargar lista de clientes
    loadClients: function() {
        $.ajax({
            url: '/proyectos/getClients',
            type: 'GET',
            success: (response) => {
                const clientSelect = $('#clients');
                clientSelect.empty();
                clientSelect.append('<option value="">Seleccione un cliente</option>');
                
                response.forEach(client => {
                    clientSelect.append(`
                        <option value="${client.id}">${client.nombre} </option>
                    `);
                });
            },
            error: (xhr) => {
                this.showAlert('Error', 'No se pudieron cargar los clientes', 'error');
            }
        });
    },

    // Cargar presupuestos del cliente
    loadClientBudgets: function(clientId) {
        if (!clientId) {
            $('#budget_id').empty().append('<option value="">Seleccione un Presupuesto</option>');
            return;
        }

        $.ajax({
            url: `/proyectos/${clientId}/getBudgets`,
            type: 'GET',
            success: (response) => {
                const projectSelect = $('#budget_id');
                projectSelect.empty();
                projectSelect.append('<option value="">Seleccione un Presupuesto</option>');
                
                response.budgets.forEach(project => {
                    projectSelect.append(`
                        <option value="${project.id}">Presupuesto ${project.id} - ${numberFormat.format(project.total)} ${project.currency.abbreviation} </option>
                    `);
                });
            },
            error: (xhr) => {
                this.showAlert('Error', 'No se pudieron cargar los proyectos', 'error');
            }
        });
    },

    // Enlazar eventos
    bindEvents: function() {
        // Evento cambio de cliente
        $(document).on('change', '#clients', (e) => {
            const clientId = $(e.currentTarget).val();
            this.loadClientBudgets(clientId);
        });

        // Evento submit del formulario
        $(document).on('submit', '#projectForm', (e) => {
            e.preventDefault();
            this.saveProject();
        });
    },

    // Guardar proyecto
    saveProject: function() {
        // Validar campos obligatorios
        const requiredFields = {
            'name': 'Nombre del proyecto',
            'description': 'Descripción',
            'budget_id': 'Presupuesto',
            'start_date': 'Fecha de inicio',
            'end_date': 'Fecha de finalización',
            'address': 'Dirección',
            'location': 'Ubicación',
            'province': 'Provincia'
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

        if (!isValid) {
            this.showAlert('Error de validación', errorMessage, 'error');
            return;
        }

        // Crear FormData para enviar archivos
        const formData = new FormData($('#projectForm')[0]);

        // Mostrar indicador de carga
        $('#saveProject').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...');

        $.ajax({
            url: '/proyectos',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (response) => {
                this.showAlert('Éxito', 'Proyecto creado correctamente', 'success');
                // Redirigir a la lista de proyectos
                window.location.href = '/proyectos';
            },
            error: (xhr) => {
                let errorMessage = 'No se pudo crear el proyecto';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                this.showAlert('Error', errorMessage, 'error');
            },
            complete: () => {
                // Restaurar botón
                $('#saveProject').prop('disabled', false).text('Guardar Proyecto');
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
    ProjectFormModule.init();
});
