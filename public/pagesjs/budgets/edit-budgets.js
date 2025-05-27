/**
 * Módulo de Edición de Presupuestos
 * Maneja la edición y actualización de presupuestos existentes
 */

'use strict';



// Inicializar módulo al cargar la página
$(document).ready(function() {

    // Variables globales
    let budgetId = $('#formOrder').data('budget-id');
    let partidas = [];
    let clientes = [];
    let monedas = [];

    // Cargar datos iniciales
    loadInitialData();

    // Función para cargar datos iniciales
    function loadInitialData() {
        // Cargar clientes
        $.get('/presupuestos/getClients', function(data) {
            clientes = data;
            let clientSelect = $('#clients');
            clientes.forEach(cliente => {
                clientSelect.append('<option value="' + cliente.id + '">' + cliente.nombre + '</option>');
            });
        });

        // Cargar monedas
        $.get('/presupuestos/getCurrencies', function(data) {
            monedas = data;
            let currencySelect = $('#currency_id');
            monedas.forEach(moneda => {
                currencySelect.append('<option value="' + moneda.id + '">' + moneda.name + ' (' + moneda.abbreviation + ')' + '</option>');
            });
        });

        // Cargar datos del presupuesto
        $.get(`/presupuestos/${budgetId}/getBudget`, function(data) {
            // Establecer valores iniciales
            $('#clients').val(data.budget.customer_id).trigger('change');
            $('#currency_id').val(data.budget.currency_id).trigger('change');
            
            console.log(data.budget.items);
            
            // Cargar partidas
            partidas = data.budget.items || [];
            updateTable();
        });
    }

    // Función para actualizar la tabla
    function updateTable() {
        let tbody = $('#tablePresupuesto tbody');
        tbody.empty();
        let total = 0;
        
        partidas.forEach((partida, index) => {
            total += parseFloat(partida.amount);
            tbody.append('<tr>' +
                '<td>' + partida.type + '</td>' +
                '<td class="text-start">$ ' + parseFloat(partida.amount).toLocaleString('es-AR', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>' +
                '<td><button type="button" class="btn btn-danger btn-sm btnEliminarPartida" data-index="' + index + '"><i class="ri-delete-bin-2-line"></i></button></td>' +
            '</tr>');
        });

        // Footer con el total
        if($('#tablePresupuesto tfoot').length === 0) {
            $('#tablePresupuesto').append('<tfoot><tr><th class="text-end">Total</th><th colspan="2" class="text-start" id="totalPresupuesto"></th></tr></tfoot>');
        }
        $('#totalPresupuesto').text('$ ' + total.toLocaleString('es-AR', {minimumFractionDigits: 0, maximumFractionDigits: 0}));
        
        // Guardar en input oculto
        $('#partidas_array').val(JSON.stringify(partidas));

        // Actualizar el input hidden con los datos
        $('#partidas_array').val(JSON.stringify(partidas));
    }

    // Agregar nueva partida
    $('#addBudget').click(function() {
        let type = $('#partidaporfundir select').val();
        let amount = $('#partidaporfundir .amount').val();

        if (!type || !amount) {
            showAlert('error', 'Por favor complete todos los campos');
            return;
        }

        partidas.push({
            type: type,
            amount: amount
        });

        updateTable();
        
        // Limpiar campos
        $('#partidaporfundir select').val('').trigger('change');
        $('#partidaporfundir .amount').val('');
    });

    // Eliminar partida
    $(document).on('click', '.btnEliminarPartida', function() {
        let index = $(this).data('index');
        partidas.splice(index, 1);
        updateTable();
    });

    // Guardar presupuesto
    $('#saveOrder').click(function() {
        if (!validateForm()) {
            return;
        }

        let formData = {
            _token: $('input[name="_token"]').val(),
            client_id: $('#clients').val(),
            currency_id: $('#currency_id').val(),
            partidas: JSON.stringify(partidas)
        };

        $.ajax({
            url: `/presupuestos/${budgetId}/update`,
            method: 'PUT',
            data: formData,
            success: function(response) {
                showAlert('success', 'Presupuesto actualizado correctamente');
                setTimeout(() => {
                    window.location.href = '/presupuestos';
                }, 1500);
            },
            error: function(xhr) {
                showAlert('error', 'Error al actualizar el presupuesto');
            }
        });
    });

    // Validación del formulario
    function validateForm() {
        if (!$('#clients').val()) {
            showAlert('error', 'Por favor seleccione un cliente');
            return false;
        }
        if (!$('#currency_id').val()) {
            showAlert('error', 'Por favor seleccione una moneda');
            return false;
        }
        if (partidas.length === 0) {
            showAlert('error', 'Por favor agregue al menos una partida');
            return false;
        }
        return true;
    }

    // Función para mostrar alertas
    function showAlert(type, message) {
        Swal.fire({
            icon: type,
            title: type === 'success' ? '¡Éxito!' : '¡Error!',
            text: message,
            timer: 2000,
            showConfirmButton: false
        });
    }
}); 