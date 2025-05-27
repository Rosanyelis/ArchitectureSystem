/**
 * Módulo de Presupuestos (BudgetModule)
 * Organización y buenas prácticas para gestión de presupuestos y clientes
 */

'use strict';

const BudgetModule = {
    partidas: [],

    // Inicialización del módulo
    init: function() {
        this.cargarClientes();
        this.cargarMonedas();
        this.actualizarTablaPresupuestos();
        this.bindEvents();
    },

    // Enlazar eventos
    bindEvents: function() {
        // Agregar partida
        $(document).on('click', '#addBudget', (e) => {
            this.agregarPartida();
        });
        // Eliminar partida
        $(document).on('click', '.btnEliminarPartida', (e) => {
            const idx = $(e.currentTarget).data('idx');
            this.eliminarPartida(idx);
        });
        // Guardar cliente desde el modal
        $(document).on('click', '#saveClient', (e) => {
            e.preventDefault();
            this.crearCliente();
        });
        // Guardar presupuesto
        $(document).on('click', '#saveOrder', (e) => {
            e.preventDefault();
            this.crearPresupuesto();
        });
    },

    // Mostrar alertas centralizadas
    mostrarAlerta: function(title, text, icon) {
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

    // Llenar el selector de clientes
    cargarClientes: function() {
        $.ajax({
            url: '/presupuestos/getClients',
            type: 'GET',
            dataType: 'json',
            success: (res) => {
                const $select = $('#clients');
                $select.empty();
                $select.append('<option value="">-- Seleccionar --</option>');
                const clientes = res.data ? res.data : res;
                clientes.forEach(cliente => {
                    const nombre = cliente.nombre || cliente.comitente || (cliente.nombre + ' ' + (cliente.apellido || ''));
                    $select.append('<option value="' + cliente.id + '">' + nombre + '</option>');
                });
                $select.trigger('change');
            },
            error: () => {
                this.mostrarAlerta('Error', 'No se pudieron cargar los clientes', 'error');
            }
        });
    },

    // Llenar el selector de monedas
    cargarMonedas: function() {
        $.ajax({
            url: '/presupuestos/getCurrencies', // Ajusta la ruta si es diferente
            type: 'GET',
            dataType: 'json',
            success: (res) => {
                const $select = $('#currency_id');
                $select.empty();
                $select.append('<option value="">-- Seleccionar --</option>');
                const monedas = res.data ? res.data : res;
                monedas.forEach(moneda => {
                    $select.append('<option value="' + moneda.id + '">' + moneda.name + ' (' + moneda.abbreviation + ')' + '</option>');
                });
                $select.trigger('change');
            },
            error: () => {
                this.mostrarAlerta('Error', 'No se pudieron cargar las monedas', 'error');
            }
        });
    },

    // Crear cliente desde el modal
    crearCliente: function() {
        const data = {
            nombre: $('#name').val().trim(),
            apellido: $('#lastname').val().trim(),
            telefono: $('#phone').val().trim(),
            correo: $('#correo').val().trim(),
            provincia: $('#provincia').val().trim(),
            domicilio: $('#domicilio').val().trim(),
            localidad: $('#localidad').val().trim(),
            _token: $('input[name="_token"]').val()
        };
        // Validación: ningún campo puede estar vacío
        for (const key in data) {
            if (key !== '_token' && (!data[key] || data[key].length === 0)) {
                this.mostrarAlerta('Error', 'Todos los campos son obligatorios', 'error');
                return;
            }
        }
        $.ajax({
            url: '/presupuestos/storeClient',
            type: 'POST',
            data: data,
            success: (res) => {
                this.mostrarAlerta('Éxito', 'Cliente creado correctamente', 'success');
                $('#AddClientModal').modal('hide');
                $('#AddClientModal input').val('');
                this.cargarClientes();
            },
            error: (xhr) => {
                let msg = 'Error al crear el cliente';
                if(xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                this.mostrarAlerta('Error', msg, 'error');
            }
        });
    },

    // Agregar partida a la tabla
    agregarPartida: function() {
        const tipo = $('#partidaporfundir select.form-select').val();
        const monto = $('#partidaporfundir input.amount').val();
        if(!tipo || !monto || isNaN(monto) || parseFloat(monto) <= 0) {
            this.mostrarAlerta('Error', 'Debe seleccionar un tipo de presupuesto y un monto válido', 'error');
            return;
        }
        this.partidas.push({ tipo: tipo, monto: parseFloat(monto) });
        this.actualizarTablaPresupuestos();
        // Limpiar campos
        $('#partidaporfundir select.form-select').val('').trigger('change');
        $('#partidaporfundir input.amount').val('');
    },

    // Eliminar partida
    eliminarPartida: function(idx) {
        this.partidas.splice(idx, 1);
        this.actualizarTablaPresupuestos();
    },

    // Actualizar la tabla y el total
    actualizarTablaPresupuestos: function() {
        const $tbody = $('#tablePresupuesto tbody');
        $tbody.empty();
        let total = 0;
        this.partidas.forEach((p, idx) => {
            total += parseFloat(p.monto);
            $tbody.append('<tr>' +
                '<td>' + p.tipo + '</td>' +
                '<td class="text-start">$ ' + parseFloat(p.monto).toLocaleString('es-AR', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>' +
                '<td><button type="button" class="btn btn-danger btn-sm btnEliminarPartida" data-idx="' + idx + '"><i class="ri-delete-bin-2-line"></i></button></td>' +
            '</tr>');
        });
        // Footer con el total
        if($('#tablePresupuesto tfoot').length === 0) {
            $('#tablePresupuesto').append('<tfoot><tr><th class="text-end">Total</th><th colspan="2" class="text-start" id="totalPresupuesto"></th></tr></tfoot>');
        }
        $('#totalPresupuesto').text('$ ' + total.toLocaleString('es-AR', {minimumFractionDigits: 0, maximumFractionDigits: 0}));
        // Guardar en input oculto
        $('#partidas_array').val(JSON.stringify(this.partidas));
    },

    // (Opcional) Función para ver un cliente (puedes expandirla si lo necesitas)
    viewRecord: function(id) {
        $.ajax({
            url: "/clientes/" + id + "/show",
            type: 'GET',
            success: function(res) {
                $('#name').val('');
                $('#lastname').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#state').val('');
                $('#name').val(res.nombre);
                $('#lastname').val(res.apellido);
                $('#email').val(res.correo);
                $('#phone').val(res.telefono);
                $('#provincia').val(res.provincia);
                $('#localidad').val(res.localidad);
                $('#domicilio').val(res.domicilio);
                $('#ClientModal').modal('show');
            }
        });
    },

    // (Opcional) Función para eliminar un cliente (puedes expandirla si lo necesitas)
    deleteRecord: function(id) {
        Swal.fire({
            title: '¿Está seguro de eliminar este Registro?',
            text: "No podra recuperar la información!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                cancelButton: 'btn btn-outline-danger waves-effect'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/clientes/"+id+"/destroy";
            }
        })
    },

    // Crear presupuesto
    crearPresupuesto: function() {
        // Validar cliente seleccionado
        const clienteId = $('#clients').val();
        if (!clienteId) {
            this.mostrarAlerta('Error', 'Debe seleccionar un cliente', 'error');
            return;
        }
        // Validar que haya partidas
        if (this.partidas.length === 0) {
            this.mostrarAlerta('Error', 'Debe agregar al menos un tipo de presupuesto', 'error');
            return;
        }
        // Validar tipo de moneda (asumiendo que hay un select o radio con name="moneda")
        const moneda = $('#currency_id').val();
        if (!moneda) {
            this.mostrarAlerta('Error', 'Debe seleccionar el tipo de moneda del presupuesto', 'error');
            return;
        }

        // Cambiar botón a loading
        const $btn = $('#saveOrder');
        $btn.prop('disabled', true);
        const originalHtml = $btn.html();
        $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');

        // Preparar datos
        const data = {
            _token: $('input[name="_token"]').val(),
            client_id: clienteId,
            currency_id: moneda,
            partidas: JSON.stringify(this.partidas)
        };

        $.ajax({
            url: $('#formOrder').attr('action'),
            type: 'POST',
            data: data,
            success: (res) => {
                this.mostrarAlerta('Éxito', 'Presupuesto guardado correctamente', 'success');
                setTimeout(() => {
                    window.location.href = '/presupuestos';
                }, 1200);
            },
            error: (xhr) => {
                let msg = 'Error al guardar el presupuesto';
                if(xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                this.mostrarAlerta('Error', msg, 'error');
                $btn.prop('disabled', false);
                $btn.html(originalHtml);
            }
        });
    }
};

// Inicializar módulo al cargar la página
$(document).ready(function() {
    BudgetModule.init();
});
