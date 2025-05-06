/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables');

$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            

        });
    }


});

function viewRecord(id) {
    
    $.ajax({
        url: "/clientes/" + id + "/show",
        type: 'GET',
        success: function(res) {
            console.log(res);
            // limpiamos campos antes de mostrar
            
            $('#name').val('');
            $('#lastname').val('');
            
            $('#email').val('');
            $('#phone').val('');
            $('#state').val('');
            
            // mostramos campos
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

}

function deleteRecord(id) {
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
            window.location.href =
                "/clientes/"+id+"/destroy";
        }
    })
}
