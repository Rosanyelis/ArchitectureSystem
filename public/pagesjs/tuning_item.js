'use strict';

$(function () {
    var dt_ajax_table = $('.datatables');
    var selectedItems = [];
    var $generateOrderBtn = $('#generate-order-btn');
    var $totalFinalWeight = $('#total_final_weight');
    var $totalRefined = $('#total_refined');
    var $totalCost = $('#total_cost');
    var $selectedItemsList = $('#selected-items-list');
    var $confirmOrderBtn = $('#confirm-order-btn');
    var $providerSelect = $('#provider-select');
    var $selectedItemsInput = $('#selected-items');
    var $selectedItemsTable = $('#selected-items-table');
    const numberFormat2 = new Intl.NumberFormat('es-MX');

    function updateTotals() {
        let totalFinalWeight = 0;
        let totalRefined = 0;
        let totalCost = 0;

        selectedItems.forEach(item => {
            totalFinalWeight += parseFloat(item.final_weight);
            totalRefined += parseFloat(item.total_refined);
            totalCost += parseFloat(item.total_amount);
        });

        $totalFinalWeight.text(totalFinalWeight);
        $totalRefined.text(totalRefined);
        $totalCost.text(totalCost);

        // Habilitar o deshabilitar el botón de generar orden
        $generateOrderBtn.prop('disabled', selectedItems.length === 0);
    }

    function updateSelectedItemsList() {
        $selectedItemsList.empty();
        let totalgr = 0;
        let totalrefinado = 0;
        let totalcosto = 0;
        selectedItems.forEach(item => {
            $selectedItemsList.append(`<li class="list-group-item">Orden #${item.order_id} - ${item.material.name} - ${item.type_product.name} - ${item.final_weight} gr - ${item.total_refined} gr - $ ${numberFormat2.format(item.total_amount)} </li>`);
            totalgr += parseFloat(item.final_weight);
            totalrefinado += parseFloat(item.total_refined);
            totalcosto += parseFloat(item.total_amount);
        });

        $selectedItemsTable.append(`<tr>
            <td >${totalgr.toFixed(3)}</td><td>${totalrefinado.toFixed(3)}</td><td>${totalcosto.toFixed(3)}</td>
        </tr>`);

        $confirmOrderBtn.prop('disabled', !$providerSelect.val() || selectedItems.length === 0);
    }

    function updateHiddenInput() {
        $selectedItemsInput.val(JSON.stringify(selectedItems));
    }

    function handleSelectionChange(checkbox) {
        const rowId = $(checkbox).val();
        const rowData = dataTable.row(`#row_${rowId}`).data();
        // $(checkbox).closest('tr').data();
        if ($(checkbox).is(':checked')) {
            selectedItems.push(rowId);
            selectedItemsTr.push(rowData);
        } else {
            selectedItems = selectedItems.filter(item => item.id !== rowId);
        }
        updateTotals();
        updateSelectedItemsList();
        updateHiddenInput();
    }
   

    // Manejar cambios en el checkbox de selección
    $(document).on('change', '.item-checkbox', function () {
        handleSelectionChange(this);
    });

    // Manejar selección de proveedor
    $providerSelect.on('change', function () {
        $confirmOrderBtn.prop('disabled', !$(this).val() || selectedItems.length === 0);
    });

    // Configuración de DataTables
    if (dt_ajax_table.length) {
        dt_ajax_table.DataTable({
            processing: true,
            serverSide: true,
            ajax: "/afinacion-de-partidas/create",
            dataType: 'json',
            type: "POST",
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            columns: [
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return `<div class="form-check font-size-16">
                            <input class="form-check-input item-checkbox" type="checkbox" value="${row.id}">
                            <label class="form-check-label"></label>
                        </div>`;
                    }
                },
                { data: 'order_id' },
                { data: 'material.name', name: 'material_name' },
                { data: 'type_product.name' },
                { data: 'final_weight' },
                { data: 'total_refined' },
                { data: 'total_amount',
                    render: function (data, type, row) {
                        return `$ ${numberFormat2.format(data)}`;
                    }
                 }
            ],

            rowCallback: function (row, data) {
                $(row).data(data); // Almacenar datos en la fila
            }
        });
    }
});
