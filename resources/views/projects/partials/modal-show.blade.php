<div class="modal fade" id="ViewBudgetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Presupuesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-5">
                
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cliente:</label>
                            <p id="cliente-nombre" class="mb-0"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha del Presupuesto:</label>
                            <p id="fecha-presupuesto" class="mb-0"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Moneda:</label>
                            <p id="tipo-moneda" class="mb-0"></p>
                        </div>
                    </div>
                     
                    <div class="col-md-12">
                        <div class="table-responsive text-nowrap">
                            <table id="tablePresupuesto" class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Tipo de Presupuesto</th>
                                        <th scope="col">Costo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-end">Total</th>
                                        <th class="text-start" id="total">0</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive text-nowrap">
                            <table id="tablePagos" class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Método de Pago</th>
                                        <th scope="col">Tasa del Dólar</th>
                                        <th scope="col">Monto en Dólares</th>
                                        <th scope="col">Monto en Pesos</th>
                                        <th scope="col">Concepto</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

