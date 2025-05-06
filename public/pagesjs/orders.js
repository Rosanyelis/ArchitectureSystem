/**
 * Sistema de gestión de partidas para fundidora - Versión Mejorada
 * - Campos editables en la tabla
 * - Persistencia en localStorage
 * - Actualización automática del arreglo partidas
 * - Mejor experiencia de usuario
 */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
    // Elementos del DOM
    const $partidaporfundir = $('#partidaporfundir');
    const $partidasinfundir = $('#partidasinfundir');
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
    hideInitialSections();
    loadFromLocalStorage(); // Cargar datos guardados al iniciar

    /**
     * Carga datos desde localStorage sin duplicar registros 
     */
    function loadFromLocalStorage() {
        console.log('Cargando datos de localStorage...');
        
        // Limpiar la tabla antes de cargar
        $tablePartida.empty();
        partidas = []; // Reiniciar el arreglo
        
        const savedPartidas = localStorage.getItem(STORAGE_KEY);
        const savedId = localStorage.getItem(STORAGE_ID_KEY);
        
        if (savedPartidas) {
            try {
                const loadedPartidas = JSON.parse(savedPartidas);
                console.log('Partidas encontradas en storage:', loadedPartidas);
                
                // Filtrar partidas nulas o indefinidas
                partidas = loadedPartidas.filter(p => p !== null && p !== undefined);
                
                // Agregar todas las partidas al table (ya están filtradas)
                partidas.forEach(partida => {
                    addEditablePartidaToTable(partida, false);
                });
                
                console.log('Partidas cargadas:', partidas);
            } catch (error) {
                console.error('Error al parsear partidas:', error);
                partidas = [];
                clearLocalStorage(); // Limpiar datos corruptos
            }
        }
        
        if (savedId) {
            currentId = parseInt(savedId);
            console.log('CurrentId cargado:', currentId);
        } else {
            currentId = partidas.length > 0 ? 
                Math.max(...partidas.map(p => p.id)) + 1 : 
                1;
            console.log('CurrentId generado:', currentId);
        }
    }


    /**
     * Guarda datos en localStorage
     */
    function saveToLocalStorage() {
        console.log('Guardando en localStorage:', partidas);
        
        try {
            // Asegurarse que todos los campos estén correctamente nombrados
            const partidasToSave = partidas.map(partida => {
                return {
                    ...partida,
                    // Asegurar nombre consistente del campo
                    total_refined: partida.total_refined || partida.total_refined || ''
                };
            });
            
            localStorage.setItem(STORAGE_KEY, JSON.stringify(partidasToSave));
            localStorage.setItem(STORAGE_ID_KEY, currentId.toString());
            
            // Verificar que se guardó correctamente
            const verify = localStorage.getItem(STORAGE_KEY);
            console.log('Verificación de guardado:', verify !== null);
        } catch (error) {
            console.error('Error al guardar en localStorage:', error);
        }
    }

    /**
     * Limpia datos de localStorage
     */
    function clearLocalStorage() {
        localStorage.removeItem(STORAGE_KEY);
        localStorage.removeItem(STORAGE_ID_KEY);
    }

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
     * Oculta secciones iniciales
     */
    function hideInitialSections() {
        $partidaporfundir.hide();
        $partidasinfundir.hide();
        $typepartida.hide();
    }

    /**
     * Muestra/oculta secciones según estado de fundición y maneja el estado del selector de tipo de partida
     */
    function toggleMeltedSections() {
        const melted = $(this).val();
        const $typePartidaSelect = $('#type_partida');
        
        // Mostrar/ocultar secciones
        $partidasinfundir.toggle(melted === 'No');
        $partidaporfundir.toggle(melted === 'Si');
        $typepartida.toggle(melted === 'No');
        
        // Habilitar/deshabilitar el select de tipo de partida
        if (melted === 'Si') {
            $typePartidaSelect.val('').prop('disabled', true);
            $('.legal_content, #fine_gold_weight, .total_amount').val('');
        } else {
            $typePartidaSelect.prop('disabled', false);
        }
        
        // Actualizar cálculos si es necesario
        recalculateAll();
    }

    /**
    * Inicialización mejorada de los listeners
    */
    function initEventListeners() {
        // Configurar el evento change para el select de fundido
        $('#melted').on('change', toggleMeltedSections).trigger('change'); // Disparar al cargar
          
        // Cálculos automáticos en el formulario
        $('#material_id').on('change', handleMaterialChange);
        $('.legal_content, #net_weight').on('change', calculateRefinedWeight);
        $('#agreed_weight, #fine_gold_weight, #cantidad').on('change', calculateTotalAmount);
        $('#type_partida').on('change', recalculateAll);
        
        // Manejo de partidas
        $('.add-item-sinfundir').on('click', addItemWithoutMelting);
        $('.add-item-porfundir').on('click', addItemWithMelting);
        $tablePartida.on('click', '.delete-product', deleteItem);
        
        // Eventos para campos editables en la tabla
        $tablePartida.on('change', '.editable-input', updatePartidaFromTable);
        $tablePartida.on('change', '.editable-select', updatePartidaFromTable);
        
        // Guardar orden
        $('#saveOrder').on('click', saveOrder);
        
        // Guardar en localStorage antes de recargar
        window.addEventListener('beforeunload', () => {
            if (partidas.length > 0) saveToLocalStorage();
        });
    }
    
    /**
     * Maneja cambio de material (caso especial para Centenario)
     */
    function handleMaterialChange() {
        if ($(this).val() === 'Centenario') {
            $('#net_weight').val('41.7');
            $('.legal_content').val('.900');
            calculateRefinedWeight();
        }
    }

    /**
     * Calcula peso refinado
     */
    function calculateRefinedWeight() {
        const netWeight = parseFloat($('#net_weight').val()) || 0;
        const legalContent = parseFloat($('.legal_content').val()) || 0;
        const totalRefined = netWeight * legalContent;
        $('#fine_gold_weight').val(truncarDecimales(totalRefined, 1)).trigger('change');
    }

    /**
     * Calcula monto total según tipo de partida
     */
    function calculateTotalAmount() {
        const type = $('#type_partida').val();
        const cantidad = parseInt($('#cantidad').val()) || 0;
        const agreedWeight = parseFloat($('#agreed_weight').val()) || 0;
        const totalRefined = parseFloat($('#fine_gold_weight').val()) || 0;
        
        let totalAmount = 0;
        
        if (type === 'Gramos') {
            totalAmount = agreedWeight * totalRefined;
        } else if (type === 'Pieza') {
            totalAmount = agreedWeight * cantidad;
        }
        
        $('.total_amount').val(truncarDecimales(totalAmount, 0));
    }

    /**
     * Recalcula todos los valores
     */
    function recalculateAll() {
        calculateRefinedWeight();
        calculateTotalAmount();
    }

   
    /**
     * Agrega partida sin fundir con campos editables
     */
    function addItemWithoutMelting() {
        const requiredFields = [
            '#material_id', '#type_product_id', '#type_partida',
            '#net_weight', '#agreed_weight', '#melted',
            '.legal_content', '#fine_gold_weight', '.total_amount'
        ];
        
        if (!validateRequiredFields(requiredFields)) {
            showError('No puede dejar campos vacíos al intentar agregar una partida');
            return false;
        }
        
        const partida = {
            id: currentId++,
            material: $('#material_id').val(),
            typeproduct: $('#type_product_id').val(),
            type_partida: $('#type_partida').val(),
            description: $('#description').val(),
            quantity: $('#cantidad').val(),
            net_weigth: $('#net_weight').val(),
            agreed_weight: $('#agreed_weight').val(),
            melted: $('#melted').val(),
            final_weight: $('#net_weight').val(),
            sample_weight: '',
            legal_content: $('.legal_content').val(),
            total_refined: $('#fine_gold_weight').val(),
            total_amount: $('.total_amount').val()
        };
        
        addEditablePartidaToTable(partida);
        resetFormFields();
    }

    /**
     * Agrega partida para fundir con campos editables
     */
    function addItemWithMelting() {
        const requiredFields = [
            '.material_id', '.type_product_id',
            '.net_weight', '.agreed_weight', '#melted'
        ];
        
        if (!validateRequiredFields(requiredFields)) {
            showError('No puede dejar campos vacíos al intentar agregar una partida');
            return false;
        }
        
        const partida = {
            id: currentId++,
            material: $('.material_id').val(),
            typeproduct: $('.type_product_id').val(),
            description: $('.description').val(),
            net_weigth: $('.net_weight').val(),
            quantity: 1,
            agreed_weight: $('.agreed_weight').val(),
            melted: $('#melted').val(),
            final_weight: '',
            sample_weight: '',
            legal_content: '',
            total_refined: '',
            total_amount: ''
        };
        
        addEditablePartidaToTable(partida);
        resetMeltingFormFields();
    }

    /**
     * Agrega partida a la tabla con verificación de duplicados - VERSIÓN CORREGIDA
     */
    function addEditablePartidaToTable(partida, saveToStorage = true) {
        console.log('Agregando partida ID:', partida.id);
        
        // 1. Verificar que la partida no existe ya
        if ($(`#row-${partida.id}`).length > 0) {
            console.warn('Partida ya existe en el DOM, no se agregará:', partida.id);
            return;
        }
        
        // 2. Normalizar datos
        const partidaNormalizada = {
            ...partida,
            total_refined: partida.total_refined || '',
            total_amount: partida.total_amount || ''
        };
        
        // 3. Agregar al array (si no existe)
        if (!partidas.some(p => p.id === partida.id)) {
            partidas.push(partidaNormalizada);
        }
        
        // 4. Crear la fila HTML
        const rowHTML = `
            <tr id="row-${partida.id}">
                <td>
                    <button type="button" class="btn btn-danger btn-sm p-1 delete-product" 
                        data-code="${partida.id}">
                        <i class="ri-delete-bin-fill"></i>
                    </button>
                </td>
                <td>${partida.material}</td>
                <td>${partida.typeproduct}</td>
                <td>${partida.type_partida ? `
                    <select class="form-control form-control-sm editable-select" data-field="type_partida">
                        <option value="Gramos" ${partida.type_partida === 'Gramos' ? 'selected' : ''}>Gramos</option>
                        <option value="Pieza" ${partida.type_partida === 'Pieza' ? 'selected' : ''}>Pieza</option>
                    </select>` : ''}
                </td>
                <td><input type="number" class="form-control form-control-sm editable-input" 
                    data-field="quantity" value="${partida.quantity}"></td>
                <td><input type="text" class="form-control form-control-sm editable-input" 
                    data-field="description" value="${partida.description || ''}"></td>
                <td><input type="number" step="0.1" class="form-control form-control-sm editable-input" 
                    data-field="net_weigth" value="${partida.net_weigth}"></td>
                <td><input type="number" step="0" class="form-control form-control-sm editable-input" 
                    data-field="agreed_weight" value="${partida.agreed_weight}"></td>
                <td>
                    <select class="form-control form-control-sm editable-select" data-field="melted">
                        <option value="Si" ${partida.melted === 'Si' ? 'selected' : ''}>Si</option>
                        <option value="No" ${partida.melted === 'No' ? 'selected' : ''}>No</option>
                    </select>
                </td>
                <td><input type="number" step="0.001" class="form-control form-control-sm editable-input" 
                    data-field="legal_content" value="${partida.legal_content || ''}"></td>
                <td><input type="number" step="0.001" class="form-control form-control-sm editable-input" 
                    data-field="total_refined" value="${partida.total_refined || ''}" ${partida.total_refined ? '' : 'readonly'}></td>
                <td><input type="number" step="1" class="form-control form-control-sm editable-input" 
                    data-field="total_amount" value="${partida.total_amount || ''}" ${partida.total_amount ? '' : 'readonly'}></td>
            </tr>`;
        
        // 5. Insertar en la tabla
        const $tableBody = $('#tablePartida tbody');
        if (!$tableBody.length) {
            console.error('No se encontró el elemento tbody de la tabla');
            return;
        }
        
        $tableBody.append(rowHTML);
        console.log('Partida agregada correctamente a la tabla');
        
        // 6. Guardar en localStorage si es necesario
        if (saveToStorage) {
            saveToLocalStorage();
        }
    }
     /**
     * Recalcula valores para una fila específica en la tabla
     */
     function recalculateRowValues($row, partida) {
        // Solo recalcular para partidas sin fundir
        if (partida.melted === 'No') {
            const netWeight = parseFloat(partida.net_weigth) || 0;
            const legalContent = parseFloat(partida.legal_content) || 0;
            const agreedWeight = parseFloat(partida.agreed_weight) || 0;
            const quantity = parseInt(partida.quantity) || 0;
            
            // Calcular contenido fino (gramos de oro fino)
            const totalRefined = netWeight * legalContent;
            
            // Calcular monto total según tipo de partida
            let totalAmount = 0;
            if (partida.type_partida === 'Gramos') {
                totalAmount = agreedWeight * totalRefined;
            } else if (partida.type_partida === 'Pieza') {
                totalAmount = agreedWeight * quantity;
            }
            
            // Actualizar campos en la fila
            $row.find('[data-field="total_refined"]').val(truncarDecimales(totalRefined, 1));
            $row.find('[data-field="total_amount"]').val(truncarDecimales(totalAmount, 0));
            
            // Actualizar en el arreglo
            partida.total_refined = truncarDecimales(totalRefined, 1);
            partida.total_amount = truncarDecimales(totalAmount, 0);
            
            // Guardar cambios
            saveToLocalStorage();
        }
    }

    /**
     * Actualiza la partida en el arreglo y recalcula cuando se modifica un campo
     */
    function updatePartidaFromTable() {
        // console.log('modificar valores');
        
        const $row = $(this).closest('tr');
        const id = parseInt($row.attr('id').replace('row-', ''));
        const field = $(this).data('field');
        const value = $(this).val();
        
        // Encontrar y actualizar la partida
        const partidaIndex = partidas.findIndex(p => p.id === id);
        if (partidaIndex === -1) return;
        
        partidas[partidaIndex][field] = value;
        
        // Recalcular siempre que cambie algún campo relevante
        recalculateRowValues($row, partidas[partidaIndex]);
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
/**
     * Muestra detalles de un registro
     */
window.viewRecord = function(id) {
    $.ajax({
        url: `/fundidora/${id}/show`,
        type: 'GET',
        success: function(res) {
            $('#preorden_id').val(res.id);
            $('#created_at').val(moment(res.created_at).format('DD/MM/YYYY'));
            $('#status').val(res.status);
            $('#cliente').val(res.client.type === 'Fisica' 
                ? `${res.client.name} ${res.client.lastname}` 
                : res.client.company_name);

            const $tbody = $('#show_order_items tbody').empty();
            
            res.order_items.forEach(item => {
                let btn = '';
                if (item.melted === 'Si' && item.status === 'Pendiente') {
                    btn = `<a href="/fundidora/${res.id}/${item.id}/fundir-partida" 
                           data-bs-toggle="tooltip" title="Fundir Partida" 
                           class="btn btn-info btn-sm">
                           <i class="ri-exchange-fill"></i></a>`;
                }

                $tbody.append(`
                    <tr>
                        <td>${item.material.name}</td>
                        <td>${item.type_product.name}</td>
                        <td>${item.description}</td>
                        <td>${item.net_weight}</td>
                        <td>${item.agreed_weight}</td>
                        <td>${item.melted}</td>
                        <td>${item.status}</td>
                        <td>${btn}</td>
                    </tr>`
                );
            });

            $('#PreorderModal').modal('show');
        }
    });
};
// Función global truncarDecimales
window.truncarDecimales = function(numero, decimales) {
    const factor = Math.pow(10, decimales);
    const resultado = Math.floor(numero * factor) / factor;
    return resultado.toFixed(decimales);
};