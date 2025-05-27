/**
 * Sistema de gestión de partidas para fundidora - Versión Mejorada
 * - Campos editables en la tabla
 * - Persistencia en localStorage
 * - Actualización automática del arreglo partidas
 * - Mejor experiencia de usuario
 */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
    
    const $typepartida = $('#typepartida');
    const $tablePartida = $('#tablePartida tbody');
    const $formOrder = $('#formOrder');
    
    // Variables de estado
    let partidas = [];
    let currentId = 1;
    
    // Constantes para localStorage
    const STORAGE_KEY = 'fundidora_partidas';
    const STORAGE_ID_KEY = 'fundidora_currentId';
    
    // Inicialización
    initDataTable();
    initEventListeners();
    


    /**
     * Inicializa DataTable para listado principal
     */
    function initDataTable() {
        const dtAjaxTable = $('.datatables');
        
        if (dtAjaxTable.length) {
            dtAjaxTable.DataTable({
                processing: true,
                serverSide: true,
                url: "/fundidora",
                type: "POST",
                dataType: 'json',
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: getDataTableLanguageConfig(),
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'cliente', name: 'cliente'},
                    {data: 'total_items', name: 'total_items'},
                    {data: 'total_fundir', name: 'total_fundir'},
                    {data: 'status', name: 'status'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        targets: [1],
                        render: (data) => moment(data).format('DD/MM/YYYY')
                    },
                    {
                        targets: [5],
                        render: (data) => {
                            const statusClasses = {
                                'Pendiente': 'bg-warning',
                                'En proceso': 'bg-info',
                                'Listo para la Compra': 'bg-success'
                            };
                            return `<span class="badge ${statusClasses[data]}">${data}</span>`;
                        }
                    }
                ]
            });
        }
    }


    /**
     * Elimina partida de la lista
     */
    function deleteItem() {
        const id = $(this).data('code');
        partidas = partidas.filter(item => item.id !== id);
        $(`#row-${id}`).remove();
        saveToLocalStorage();
    }

    /**
     * Guarda la orden completa
     */
    function saveOrder() {
        if ($('#client_id').val() === '') {
            showError('Debe seleccionar un cliente');
            return false;
        }

        if (partidas.length === 0) {
            showError('No hay partidas para guardar');
            return false;
        }

        $('#partidas_array').val(JSON.stringify(partidas));
        
        // Limpiar localStorage al guardar
        clearLocalStorage();
        
        $formOrder.submit();
        
        const $saveBtn = $('#saveOrder');
        $saveBtn.prop('disabled', true);
        $saveBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
    }
    /**
     * Valida campos requeridos
     */
    function validateRequiredFields(fields) {
        return fields.every(field => $(field).val() !== '');
    }

    /**
     * Muestra mensaje de error
     */
    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
            position: 'top-center',
            customClass: { confirmButton: 'btn btn-primary waves-effect waves-light' },
            buttonsStyling: false
        });
    }
    /**
     * Resetea campos del formulario sin fundir
     */
    function resetFormFields() {
        $('#material_id, #type_product_id, #type_partida').val('').trigger('change');
        $('#description, #cantidad, #net_weight, #agreed_weight').val('');
        $('#melted, .legal_content, #fine_gold_weight, .total_amount').val('');
        hideInitialSections();
    }

    /**
     * Resetea campos del formulario para fundir
     */
    function resetMeltingFormFields() {
        $('.material_id, .type_product_id').val('').trigger('change');
        $('.description, .net_weight, .agreed_weight').val('');
        $('#melted').val('');
        hideInitialSections();
    }

});

// Función global truncarDecimales
window.truncarDecimales = function(numero, decimales) {
    const factor = Math.pow(10, decimales);
    const resultado = Math.floor(numero * factor) / factor;
    return resultado.toFixed(decimales);
};