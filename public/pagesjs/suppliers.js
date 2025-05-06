/**
 * Configuración avanzada para gestión de proveedores
 * - DataTables con AJAX
 * - Manejo de formularios dinámicos
 * - Búsqueda de códigos postales
 * - Modales para visualización/eliminación
 */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
    initDataTable();
});

/**
 * Inicializa DataTable para proveedores
 */
const initDataTable = () => {
    const table = $('.datatables');
    if (!table.length) return;

    table.DataTable({
        processing: true,
        serverSide: true,
        url: "/proveedores",
        type: "POST",
        dataType: 'json',
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
            paginate: {
                next: '<i class="ri-arrow-right-s-line"></i>',
                previous: '<i class="ri-arrow-left-s-line"></i>'
            }
        },
        columns: [
            { data: 'razon_social', name: 'razon_social' },
            { data: 'proveedor', name: 'proveedor' },
            { data: 'cuit', name: 'cuit'},
            { data: 'correo', name: 'correo'},
            { data: 'telefono', name: 'telefono' },
            { data: 'provincia', name: 'provincia' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [

        ]
    });
};

function viewRecord(id) {
    
    $.ajax({
        url: "/proveedores/" + id + "/show",
        type: 'GET',
        success: function(res) {
            console.log(res);
            // limpiamos campos antes de mostrar
            $('#razon_social').val('');
            $('#cuit').val('');
            $('#name').val('');
            $('#lastname').val('');
            
            $('#email').val('');
            $('#phone').val('');
            $('#state').val('');
            
            // mostramos campos
            $('#razon_social').val(res.razon_social);
            $('#name').val(res.nombre);
            $('#lastname').val(res.apellido);
            $('#cuit').val(res.cuit);
            $('#email').val(res.correo);
            $('#phone').val(res.telefono);
           
            $('#provincia').val(res.provincia);
            $('#localidad').val(res.localidad);
            $('#domicilio').val(res.domicilio);


            $('#ClientModal').modal('show');
        }
    });

}

/**
 * Confirma eliminación de un proveedor
 * @param {number} id - ID del proveedor a eliminar
 */
const deleteRecord = (id) => {
    Swal.fire({
        title: '¿Está seguro de eliminar este registro?',
        text: "¡No podrá recuperar esta información!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
            cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/proveedores/${id}/destroy`;
        }
    });
};