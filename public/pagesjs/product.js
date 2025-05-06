"use strict";

const numberFormat = new Intl.NumberFormat("es-MX");
let selectedItems = [];
const materialCounters = {
    oro: { count: 0, fino: 0 },
    plata: { count: 0, fino: 0 },
    paladio: { count: 0, fino: 0 },
    platino: { count: 0, fino: 0 },
    centenario: { count: 0, fino: 0 }
};

// Elementos del DOM
const $selectedItemsList = $('#selected-items-list');
const modalTuning = $('#generateOrderModal');
const $selectedItemsTable = $('#selected-items-table');
const $generateOrderBtn = $('#confirm-order-btn');
const $selectedItemsInput = $('#selected-items');

// Configuración común para todas las tablas
const tableConfigs = [
    { class: "datatables-product-oro", material: "oro" },
    { class: "datatables-product-plata", material: "plata" },
    { class: "datatables-product-paladio", material: "paladio" },
    { class: "datatables-product-platino", material: "platino" },
    { class: "datatables-product-centenario", material: "centenario" }
];

$(function () {
    localStorage.setItem('products', '');
    loadInitialData();
    initializeAllDataTables();
});

function loadInitialData() {
    $.ajax({
        url: "/inventario",
        type: "GET",
        dataType: "json",
        success: function(data) {
            if (Array.isArray(data)) {
                localStorage.setItem('products', JSON.stringify(data));
            }
        },
        error: function(xhr, status, error) {
            console.error("Error loading inventory data:", error);
        }
    });
}

function initializeAllDataTables() {
    tableConfigs.forEach(config => {
        const table = $(`.${config.class}`);
        
        if (table.length) {
            initializeDataTable(table, config.material);
        }
    });
}

function initializeDataTable(tableElement, material) {
    const table = tableElement.DataTable({
        ajax: {
            url: `/productos/dataJson?material=${material}`,
            data: function(d) {
                d.status = $('#status').val();
            }
        },
        columns: getCommonColumns(),
        columnDefs: getCommonColumnDefs(),
        dom: getCommonDomConfig(),
        lengthMenu: [7, 10, 20, 50, 70, 100],
        language: getCommonLanguageConfig(),
        buttons: getCommonButtons(),
        drawCallback: function(settings) {
            resetMaterialCounters(material);
            updateMaterialCounters(this.api().data(), material);
        }
    });

    $(".dt-action-buttons").addClass("pt-0");
    $(".dt-buttons").addClass("d-flex flex-wrap");
}

function getCommonColumns() {
    return [
        {data: ''},
        {data: 'id'},
        {data: 'created_at'},
        {data: 'material'},
        {data: 'type_product'},
        {data: 'quantity'},
        {data: 'weight'},
        {data: 'fine_gold'},
        {data: 'legal_content'},
        {data: 'actions', orderable: false, searchable: false}
    ];
}

function getCommonColumnDefs() {
    return [
        {
            targets: 0,
            className: "control",
            searchable: false,
            orderable: false,
            responsivePriority: 1,
            render: function () {
                return "";
            },
        },
        {
            targets: 1,
            orderable: false,
            render: function(data, type, full) {
                if (full["status"] !== "Vendido" && full["status"] !== "En Fundicion" && full["status"] !== "Fundido") {
                    return `<input type="checkbox" class="dt-checkboxes form-check-input item-checkbox" value="${data}">`;
                }
                return "";
            },
            checkboxes: {
                selectAllRender: '<input type="checkbox" class="form-check-input">'
            },
            responsivePriority: 2
        },
        {
            targets: 2,
            responsivePriority: 3,
            render: function (data, type, full) {
                const $fecha = moment(full["created_at"]).format("DD/MM/YYYY");
                return `<span class='text-nowrap'>${$fecha}</span>`;
            },
        },
        {
            targets: 3,
            responsivePriority: 4,
            render: function (data, type, full) {
                return `<span class='text-nowrap'>${full["material"]}</span>`;
            },
        },
        {
            targets: 4,
            responsivePriority: 5,
            render: function (data, type, full) {
                return `<span class='text-nowrap'>${full["type_product"]}</span>`;
            },
        },
        {
            targets: 5,
            responsivePriority: 6,
            render: function (data, type, full) {
                return `<span class='text-nowrap'>${full["quantity"]}</span>`;
            },
        },
        {
            targets: 6,
            responsivePriority: 7,
            render: function (data, type, full) {
                return `<span class='text-nowrap'>${full["weight"]}</span>`;
            },
        },
        {
            targets: 7,
            responsivePriority: 8,
            render: function (data, type, full) {
                return `<span class='text-nowrap'>${full["fine_gold"]}</span>`;
            },
        },
        {
            targets: 8,
            responsivePriority: 9,
            render: function (data, type, full) {
                const legal_content = full["legal_content"] ?? 0;
                return `<span class='text-nowrap'>${legal_content}</span>`;
            },
        }
    ];
}

function getCommonDomConfig() {
    return '<"card-header d-flex border-top rounded-0 flex-wrap pb-md-0 pt-0"' +
        '<"me-5 ms-n2"f>' +
        '<"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center gap-4"lB>>' +
        ">t" +
        '<"row mx-1"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        ">";
}

function getCommonLanguageConfig() {
    return {
        sLengthMenu: "_MENU_",
        search: "",
        searchPlaceholder: "Buscar",
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        paginate: {
            next: '<i class="ri-arrow-right-s-line"></i>',
            previous: '<i class="ri-arrow-left-s-line"></i>',
        },
    };
}

function getCommonButtons() {
    return [       
        {
            text: '<i class="ri-test-tube-fill ri-16px me-0 me-sm-2 align-baseline"></i><span class="d-none d-sm-inline-block">Fundir</span>',
            className: "btn btn-dark waves-effect waves-light me-4 btn-sm",
            action: handleFundirAction
        },
        {
            text: '<i class="ri-temp-cold-fill ri-16px me-0 me-sm-2 align-baseline"></i><span class="d-none d-sm-inline-block"> Afinar</span>',
            className: "btn btn-warning waves-effect waves-light me-4 btn-sm",
            action: handleAfinarAction
        }
    ];
}

// Manejar cambio de selección
$(document).on('change', '.item-checkbox', function() {
    const rowId = $(this).val();
    const isChecked = $(this).is(':checked');
    
    selectedItems = selectedItems.filter(item => item.id !== rowId);
    
    if (isChecked) {
        selectedItems.push({id: rowId});
    }
});

function handleFundirAction() {
    if (selectedItems.length === 0) {
        showWarningAlert('No se ha seleccionado ningún producto');
        return;
    }
    
    $('#productos').val(JSON.stringify(selectedItems));
    $('#formFundir').submit();
}

function handleAfinarAction() {
    if (selectedItems.length === 0) {
        showWarningAlert('No se ha seleccionado ningún producto');
        return;
    }

    const dataProduct = localStorage.getItem('products');
    if (!dataProduct) {
        showWarningAlert('No hay datos de productos disponibles');
        return;
    }

    try {
        const products = JSON.parse(dataProduct);
        const productosSeleccionados = [];
        const uniqueIds = new Set();

        selectedItems.forEach(item => {
            if (!uniqueIds.has(item.id)) {
                const product = products.find(p => p.id == item.id);
                if (product) {
                    productosSeleccionados.push(product);
                    uniqueIds.add(item.id);
                }
            }
        });

        if (productosSeleccionados.length === 0) {
            showWarningAlert('No se encontraron los productos seleccionados');
            return;
        }

        updateUIWithSelectedProducts(productosSeleccionados);
        modalTuning.modal('show');
    } catch (error) {
        console.error("Error processing selected items:", error);
        showWarningAlert('Error al procesar los productos seleccionados');
    }
}

function updateUIWithSelectedProducts(productos) {
    $selectedItemsInput.val(JSON.stringify(productos));
    $selectedItemsList.empty();
    
    let totalgr = 0;
    let totalrefinado = 0;
    let totalcosto = 0;
    
    productos.forEach(item => {
        $selectedItemsList.append(`
            <li class="list-group-item">
                Orden #${item.order_id || 'N/A'} - ${item.material || 'N/A'} - 
                ${item.type_product || 'N/A'} - ${item.weight || 0} gr - 
                ${item.fine_gold || 0} gr - $ ${numberFormat.format(item.price || 0)}
            </li>
        `);
        
        totalgr += parseFloat(item.weight) || 0;
        totalrefinado += parseFloat(item.fine_gold) || 0;
        totalcosto += parseFloat(item.price) || 0;
    });
    
    $selectedItemsTable.html(`
        <tr>
            <td>${truncarDecimales(totalgr, 1)}</td>
            <td>${truncarDecimales(totalrefinado, 1)}</td>
            <td>${truncarDecimales(totalcosto, 0)}</td>
        </tr>
    `);
    
    $generateOrderBtn.prop('disabled', false);
}

function resetMaterialCounters(material) {
    if (materialCounters[material]) {
        materialCounters[material].count = 0;
        materialCounters[material].fino = 0;
    }
}

function updateMaterialCounters(data, material) {
    data.each(function(item) {
        if (item.material.toLowerCase() === material) {
            materialCounters[material].count += parseInt(item.quantity) || 0;
            materialCounters[material].fino += parseFloat(item.weight) || 0;
        }
    });

    $(`#count${capitalizeFirstLetter(material)}`).text(materialCounters[material].count);
    $(`#total_gr${capitalizeFirstLetter(material)}`).text(truncarDecimales(materialCounters[material].fino, 1));
}

function showWarningAlert(message) {
    Swal.fire({
        icon: 'warning',
        title: message,
        customClass: { confirmButton: 'btn btn-primary waves-effect waves-light' },
        buttonsStyling: false
    });
}

function truncarDecimales(numero, decimales) {
    if (typeof numero !== 'number' || typeof decimales !== 'number') {
        throw new Error('Ambos parámetros deben ser números');
    }

    const factor = Math.pow(10, decimales);
    const resultado = Math.floor(numero * factor) / factor;
    return resultado.toFixed(decimales).replace(',', '.');
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}