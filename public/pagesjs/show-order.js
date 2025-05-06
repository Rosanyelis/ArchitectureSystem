/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables');

$(function () {

    if (dt_ajax_table.length) {
        var dt_table = dt_ajax_table.dataTable({
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
        });
    }


    $('#legal_content').on('change', function () {
        var final_weight = parseFloat($('#final_weight').val());
        var legal_content = parseFloat($('#legal_content').val());
        var total_refined = final_weight * legal_content;
        if (isNaN(total_refined)) {
            total_refined = 0;
        }
        $('#total_refined').val(truncarDecimales(total_refined, 1));
    });

    $('#final_weight').on('change', function () {
        var final_weight = parseFloat($('#final_weight').val());
        var legal_content = parseFloat($('#legal_content').val());
        var total_refined = final_weight * legal_content;
        if (isNaN(total_refined)) {
            total_refined = 0;
        }
        $('#total_refined').val(truncarDecimales(total_refined, 1));
    });

    $('#legal_content').on('change', function () {
        var agreed_weight = parseFloat($('#agreed_weight').val());
        var total_refined = parseFloat($('#total_refined').val());
        var total_amount = agreed_weight * total_refined;
        if (isNaN(total_amount)) {
            total_amount = 0;
        }
        $('#total_amount').val(truncarDecimales(total_amount, 0));
    });


});
function truncarDecimales(numero, decimales) {
    if (typeof numero !== 'number' || typeof decimales !== 'number') {
        throw new Error('Ambos parámetros deben ser números');
    }

    const factor = Math.pow(10, decimales);
    const resultado = Math.floor(numero * factor) / factor;
    return resultado.toFixed(decimales).replace(',', '.');
}
