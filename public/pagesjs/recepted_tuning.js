
'use strict';

var i = 1;
var materiales = [];

$(document).ready(function() {


    $('#tuning_cost').on('change', function () {
        var total_gram_refined = parseFloat($('#total_gram_refined').val());
        var tuning_cost = parseFloat($('#tuning_cost').val());

        var total = tuning_cost * total_gram_refined;
        $('#tuning_cost_per_gram').val(truncarDecimales(total, 0));
    });

    $('#gram_coopelation').on('change', function () {
        var total_costo_gramos_refined = parseFloat($('#tuning_cost_per_gram').val());
        var coopelacion = parseFloat($('#gram_coopelation').val());

        var total = total_costo_gramos_refined + coopelacion;
        $('#total').val(truncarDecimales(total,0));
    });


    $('#costo_gramos').on('change', function () {
        var gr = parseFloat($('#gramos').val());
        var costo = parseFloat($('#costo_gramos').val());

        var total = gr * costo;
        $('#total_costo_gramos').val(truncarDecimales(total,0));
    });

    $('#addMaterial').on('click', function () {
        var material = $('#material').val();
        var gramos = $('#gramos').val();
        var costo_gramos = $('#costo_gramos').val();
        var total_costo_gramos = $('#total_costo_gramos').val();

        if (material == '' || gramos == '' || costo_gramos == '' || total_costo_gramos == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No puede dejar campos vacios al intentar agregar un material',
                position: 'top-center',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                    },
                buttonsStyling: false
            });

            return false;
        }

        materiales.push({
            'id': i,
            'material': material,
            'gramos': gramos,
            'costo_gramos': costo_gramos,
            'total_costo_gramos': total_costo_gramos
        });

        $('#tableMaterial tbody').append(
            `<tr id="row-`+i+`">
                <td>`+material+`</td>
                <td>`+gramos+`</td>
                <td>`+costo_gramos+`</td>
                <td>`+total_costo_gramos+`</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm"
                        id="delete_product" data-code="`+i+`">
                        <i class="ri-delete-bin-fill"></i>
                    </button>
                </td>
            </tr>`
        );

        i++;

        $('#material').val('');
        $('#gramos').val('');
        $('#costo_gramos').val('');
        $('#total_costo_gramos').val('');

        calculateTotal();

    });

    $('#tableMaterial tbody').on('click', '#delete_product', function() {
        let i = $(this).data('code');
        let id = "#row-" + i;
        materiales = materiales.filter(function(item) {
            return item.id !== i;
        });
        $(id).remove();

        calculateTotal();
    });

    $('#saveOrder').on('click', function() {
        $('#materiales_array').val(JSON.stringify(materiales));

        $('#formTuning').submit();

        $('#saveOrder').prop('disabled', true);
        $('#saveOrder').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
    });

});

// cacular el total de la orden al agregar un material
function calculateTotal() {
    var total = 0;
    var total_orden = parseFloat($('#total').val());

    if (materiales.length == 0) {
        total = total_orden;
    } else {
        for (var index = 0; index < materiales.length; index++) {
            total += parseFloat(materiales[index].total_costo_gramos);
        }
    }

    var $grandTotal = total + total_orden;
    // sumarlo al total de la orden actual
    $('#total').val(truncarDecimales($grandTotal,0));
}
function truncarDecimales(numero, decimales = 2) {
    if (typeof numero !== 'number' || typeof decimales !== 'number') {
        throw new Error('Ambos parámetros deben ser números');
    }

    const factor = Math.pow(10, decimales);
    const resultado = Math.floor(numero * factor) / factor;
    return resultado.toFixed(decimales).replace(',', '.');
}