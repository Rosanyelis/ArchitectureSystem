'use strict';

const PointOfSale = {
    partidas: [],
    materials: [],

    /**
     * Inicializa el punto de venta
     */
    init: function() {
        this.loadInventory()
            .then(() => {
                this.loadSavedPartidas();
                this.listarClientes();
                this.setupMaterialEventHandlers();
            })
            .catch(error => {
                console.error('Error inicializando punto de venta:', error);
                this.showAlert('Error', 'No se pudo cargar el inventario', 'error');
            });
    },

    /**
     * Carga el inventario desde el servidor
     */
    loadInventory: function() {
        return new Promise((resolve, reject) => {
            localStorage.removeItem('materials');
            $.ajax({
                url: '/listar-inventario',
                method: 'GET',
                success: (response) => {
                    this.materials = response.map(item => ({
                        id: item.id,
                        name: item.material,
                        type_product: item.type_product,
                        weight: item.weight,
                        content_fine: item.content_fine,
                        legal_content: item.legal_content
                    }));
                    
                    localStorage.setItem('materials', JSON.stringify(this.materials));
                    this.listarMateriales();
                    resolve();
                },
                error: (xhr, status, error) => {
                    console.error('Error cargando inventario:', error);
                    reject(error);
                }
            });
        });
    },

    /**
     * Carga las partidas guardadas en localStorage
     */
    loadSavedPartidas: function() {
        const savedPartidas = localStorage.getItem('partidas');
        if (savedPartidas) {
            this.partidas = JSON.parse(savedPartidas);
            this.partidas.forEach(partida => this.renderPartidaRow(partida));
            this.calcularTotal();
        }
    },

    /**
     * Configura los event handlers para los filtros de materiales
     */
    setupMaterialEventHandlers: function() {
        // Primero removemos todos los event listeners existentes
        const materialTypes = ['oro', 'plata', 'paladio', 'platino', 'centenario'];
        materialTypes.forEach(type => {
            $(`#material_${type}`).off('change');
        });

        // Luego agregamos los nuevos listeners
        materialTypes.forEach(type => {
            $(`#material_${type}`).on('change', () => {
                // Desmarcar otros checkboxes
                $(`[id^="material_"]`).not(`#material_${type}`).prop('checked', false);
                
                if ($(`#material_${type}`).is(':checked')) {
                    this.displayMaterialsByType(type);
                } else {
                    this.listarMateriales();
                }
            });
        });
    },

    /**
     * Muestra materiales filtrados por tipo
     */
    displayMaterialsByType: function(materialType) {
        // Filtramos los materiales comparando sin importar mayúsculas/minúsculas
        const filteredMaterials = this.materials.filter(m => 
            m.name.toLowerCase().includes(materialType.toLowerCase()) || 
            m.type_product.toLowerCase().includes(materialType.toLowerCase())
        );
        
        $('#productos').empty();

        if (filteredMaterials.length === 0) {
            this.showNoMaterialsMessage();
            return;
        }

        filteredMaterials.forEach(material => {
            $('#productos').append(this.createMaterialCard(material));
        });
    },

    /**
     * Muestra mensaje cuando no hay materiales
     */
    showNoMaterialsMessage: function() {
        $('#productos').html(`
            <div class="col-md-12">
                <div class="d-flex flex-column align-items-center">
                    <i class="ri-error-warning-fill ri-48px text-warning"></i> 
                    <h5>No hay materiales disponibles para este tipo.</h5>
                </div>
            </div>
        `);
    },

    /**
     * Lista todos los materiales disponibles
     */
    listarMateriales: function() {
        $('#productos').empty();
        this.materials.forEach(material => {
            $('#productos').append(this.createMaterialCard(material));
        });
    },

    /**
     * Crea la tarjeta HTML para un material
     */
    createMaterialCard: function(material) {
        return `
            <div class="col-md-4">
                <a href="javascript:void(0)" class="text-decoration-none" 
                    onclick="PointOfSale.agregarPartida(
                        ${material.id},
                        '${this.escapeHtml(material.name)}',
                        '${this.escapeHtml(material.type_product)}',
                        '${material.weight}',
                        '${material.content_fine}'
                    )">
                    <div class="card shadow-none bg-transparent border border-secondary">
                        <div class="card-body p-1">
                            <div class="d-flex flex-column align-items-center">
                                <p class="text-center mb-0" style="font-size: 0.7rem !important;">
                                    <strong>${this.escapeHtml(material.name)} - ${this.escapeHtml(material.type_product)}</strong> <br>
                                    <strong>Gr. ${material.weight} - CF. ${material.content_fine}</strong><br>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        `;
    },

    /**
     * Renderiza una fila de partida en la tabla
     */
    renderPartidaRow: function(partida) {
        const quantityStep = partida.type === 'pieza' ? '1' : '0.1';
        
        const row = `
            <tr id="partida_${partida.id}" class="text-center">
                <td>
                    <select data-id="${partida.id}" class="form-select form-select-sm type-select">
                        <option value="gramos" ${partida.type === 'gramos' ? 'selected' : ''}>Gramos</option>
                        <option value="pieza" ${partida.type === 'pieza' ? 'selected' : ''}>Pieza</option>
                    </select>
                </td>
                <td>${partida.name}</td>
                <td>${partida.content_fine}</td>
                <td>${partida.weight}</td>
                <td>
                    <input data-id="${partida.id}" 
                           class="form-control form-control-sm quantity-input" 
                           type="number" 
                           value="${partida.quantity || 0}" 
                           min="0" 
                           step="${quantityStep}">
                </td>
                <td>
                    <input data-id="${partida.id}" 
                           class="form-control form-control-sm price-input" 
                           value="${partida.price || 0}" 
                           type="number" 
                           min="0" 
                           step="0.01">
                </td>
                <td data-id="${partida.id}" class="subtotal">
                    ${partida.subtotal ? this.truncarDecimales(partida.subtotal, 0) : '0'}
                </td>
                <td>
                    <button type="button" class="btn btn-icon btn-link btn-sm text-danger"
                        onclick="PointOfSale.eliminarPartida(${partida.id})">
                        <i class="ri-delete-bin-2-fill fs-5"></i>
                    </button>
                </td>
            </tr>
        `;
        
        $('#detailSale').append(row);
        this.setupInputHandlers(partida.id);
    },

    /**
     * Configura los event handlers para una partida
     */
    setupInputHandlers: function(partidaId) {
        // Handler para cantidad y precio
        $(`#partida_${partidaId} .quantity-input, #partida_${partidaId} .price-input`)
            .off('input').on('input', () => {
                this.updatePartidaCalculations(partidaId);
            });
        
        // Handler para cambiar tipo de venta
        $(`#partida_${partidaId} .type-select`)
            .off('change').on('change', function() {
                PointOfSale.changePartidaType(partidaId, $(this).val());
            });
    },

    /**
     * Cambia el tipo de una partida (gramos/pieza)
     */
    changePartidaType: function(partidaId, newType) {
        const partida = this.partidas.find(p => p.id === partidaId);
        if (!partida) return;
        
        partida.type = newType;
        
        // Actualizar el step del input cantidad
        const quantityStep = newType === 'pieza' ? '1' : '0.1';
        $(`#partida_${partidaId} .quantity-input`).attr('step', quantityStep);
        
        // Forzar recálculo
        this.updatePartidaCalculations(partidaId);
    },

    /**
     * Actualiza los cálculos de una partida
     */
    updatePartidaCalculations: function(partidaId) {
        const partida = this.partidas.find(p => p.id === partidaId);
        if (!partida) return;
        
        const quantity = parseFloat($(`#partida_${partidaId} .quantity-input`).val()) || 0;
        const price = parseFloat($(`#partida_${partidaId} .price-input`).val()) || 0;
        const subtotal = quantity * price;

        // Validar que el contenido fino no exceda el peso actual cuando su tipo sea gramos
        if (partida.type === 'gramos') {
            const weight = parseFloat(partida.content_fine);
            if (weight < quantity) {
                this.showAlert('Error', 'La cantidad de gramos a vender no puede exceder el peso actual de contenido fino', 'error');
                $(`#partida_${partidaId} .quantity-input`).val('0');
                return;
            }
        }

        $(`#partida_${partidaId} .subtotal`).text(this.truncarDecimales(subtotal, 2));

        // Actualizar en memoria y localStorage
        partida.quantity = quantity;
        partida.price = price;
        partida.subtotal = subtotal;
        localStorage.setItem('partidas', JSON.stringify(this.partidas));
        
        this.calcularTotal();
    },

    /**
     * Agrega una nueva partida
     */
    agregarPartida: function(id, name, type_product, weight, content_fine) {
        if (this.partidas.some(p => p.id === id)) {
            this.showAlert('Error', 'Este material ya está agregado a la venta', 'error');
            return;
        }

        // Por defecto será gramos, pero el usuario puede cambiarlo después
        const nuevaPartida = {
            id, 
            name, 
            type_product, 
            weight, 
            content_fine,
            type: 'gramos',
            quantity: 0,
            price: 0,
            subtotal: 0
        };

        this.partidas.push(nuevaPartida);
        localStorage.setItem('partidas', JSON.stringify(this.partidas));
        this.renderPartidaRow(nuevaPartida);

        // Limpiar selecciones
        this.resetSelectionControls();
    },

    /**
     * Elimina una partida
     */
    eliminarPartida: function(id) {
        this.partidas = this.partidas.filter(p => p.id !== id);
        localStorage.setItem('partidas', JSON.stringify(this.partidas));
        $(`#partida_${id}`).remove();
        this.calcularTotal();
    },

    /**
     * Elimina todas las partidas
     */
    deleteAll: function() {
        this.partidas = [];
        localStorage.setItem('partidas', JSON.stringify(this.partidas));
        $('#detailSale').empty();
        this.calcularTotal();
    },

    /**
     * Calcula el total de la venta
     */
    calcularTotal: function() {
        let total = this.partidas.reduce((sum, partida) => sum + (partida.subtotal || 0), 0);
        $('#total').text(this.truncarDecimales(total, 0)); 
        $('#totalCobrar').val(this.truncarDecimales(total, 0));
    },

    /**
     * Lista los clientes disponibles
     */
    listarClientes: function() {
        $.ajax({
            url: '/listar-clientes',
            type: 'GET',
            success: (response) => {
                const clientes = response;
                $('#clients').empty();
                $('#clients').append('<option value="">Seleccione un cliente</option>');
                clientes.forEach(cliente => {
                    const option = $('<option>').val(cliente.id).text(cliente.alias + ' - ' + cliente.cliente);
                    $('#clients').append(option);
                });
            },
            error: (xhr, status, error) => {
                console.error('Error cargando clientes:', error);
            }
        });
    },

    /**
     * Crea un nuevo cliente
     */
    createNewClient: function() {
        const nombre = $('#name').val();
        const apellido = $('#lastname').val();
        const phone = $('#phone').val();
        const alias = $('#alias').val();

        if (!nombre || !apellido || !phone || !alias) {
            this.showAlert('Error', 'Todos los campos son obligatorios', 'error');
            return;
        }

        $.ajax({
            url: '/punto-de-venta/store-cliente',
            type: 'POST',
            data: {
                _token: $('#_token').val(),
                name: nombre,
                lastname: apellido,
                phone: phone,
                alias: alias
            },
            success: (response) => {
                $('#name').val('');
                $('#lastname').val('');
                $('#phone').val('');
                $('#alias').val('');
                this.listarClientes();
                this.showAlert('Éxito', 'Cliente creado con éxito', 'success');
            },
            error: (xhr, status, error) => {
                this.showAlert('Error', 'Error al crear el cliente', 'error');
            }
        });
    },

    /**
     * Guarda la venta en el servidor
     */
    saveSale: function() {
        const clienteId     = $('#clients').val();
        const account       = $('input[name="account_id"]:checked').val();
        const formPayment   = $('input[name="form_payment"]:checked').val();
        const total         = $('#total').text();
        const totalCobrar   = $('#totalCobrar').val();

        // Validaciones
        if (!clienteId) {
            this.showAlert('Error', 'Debe seleccionar un cliente', 'error');
            return;
        }

        if (this.partidas.length === 0) {
            this.showAlert('Error', 'No hay partidas para guardar', 'error');
            return;
        }

        if (!account) {
            this.showAlert('Error', 'Debe seleccionar una cuenta', 'error');
            return;
        }

        if (!formPayment) {
            this.showAlert('Error', 'Debe seleccionar un método de cobro', 'error');
            return;
        }

        // Validar que al menos una partida tenga cantidad > 0
        if (!this.partidas.some(p => p.quantity > 0)) {
            this.showAlert('Error', 'Al menos una partida debe tener cantidad mayor a cero', 'error');
            return;
        }

        const btn = $('.btnCobrar');
        btn.prop('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...');

        $.ajax({
            url: '/punto-de-venta/create',
            type: 'POST',
            data: {
                _token: $('#_token').val(),
                client_id: clienteId,
                partidas: JSON.stringify(this.partidas),
                account_id: account,
                form_payment: formPayment,
                amount_sale: total,
                sale_amount: totalCobrar
            },
            success: (response) => {
                $('#productos').empty();
                this.deleteAll();
                this.loadInventory();
                $('#clients').val('').trigger('change');
                $('input[name="account_id"]:checked').prop('checked', false);
                $('input[name="form_payment"]:checked').prop('checked', false);
                
                btn.html('<i class="ri-money-dollar-circle-line"></i> Cobrar');
                btn.prop('disabled', false);
                this.showAlert('Éxito', 'Venta guardada con éxito', 'success');
                localStorage.removeItem('sale_last');
                localStorage.setItem('sale_last', response.data.sale.id);
                
                this.modalInvoice(response.data.sale.id);
            },
            error: (xhr, status, error) => {
                btn.html('<i class="ri-money-dollar-circle-line"></i> Cobrar');
                btn.prop('disabled', false);
                this.showAlert('Error', 'Error al guardar la venta', 'error');
            }
        });
    },

    /**
     * Muestra el modal de factura
     */
    modalInvoice: function(id) {
        // limpiar el modal
        $('#modalInvoice .modal-title').html('<h5 class="modal-title">Factura de venta</h5>');
        $('#modalInvoice .modal-body').html('');
        $('#modalInvoice .modal-footer').html('');
        // agregar un iframe para pdf en el modal
        $('#modalInvoice .modal-title').html('<h5 class="modal-title">Factura de venta '+id+' </h5>');
        $('#modalInvoice .modal-body').html('<iframe src="/ventas/' + id + '/ticket" width="100%" height="500px"></iframe>');
        $('#modalInvoice').modal('show');
    },

    /**
     * Modal Invoice para mostrar la ultima venta
     */
    modalInvoiceLast: function() {
        var id = localStorage.getItem('sale_last');
        if (id) {
            this.modalInvoice(id);
        } else {
            this.showAlert('Error', 'No hay venta guardada', 'error');
        }
    },
    /**
     * Resetea los controles de selección
     */
    resetSelectionControls: function() {
        this.listarMateriales();
        $('[id^="material_"]').prop('checked', false);
    },

    /**
     * Muestra una alerta al usuario
     */
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
    },

    /**
     * Trunca decimales sin redondear (versión original)
     */
    truncarDecimales: function(numero, decimales) {
        if (typeof numero !== 'number' || typeof decimales !== 'number') {
            throw new Error('Ambos parámetros deben ser números');
        }

        const factor = Math.pow(10, decimales);
        const resultado = Math.floor(numero * factor) / factor;
        return resultado.toFixed(decimales).replace(',', '.');
    },

    /**
     * Escapa HTML para seguridad
     */
    escapeHtml: function(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    },

    /**
     * Capitaliza la primera letra de un string
     */
    capitalizeFirstLetter: function(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }
};

// Inicialización cuando el DOM esté listo
$(document).ready(function() {
    PointOfSale.init();
});