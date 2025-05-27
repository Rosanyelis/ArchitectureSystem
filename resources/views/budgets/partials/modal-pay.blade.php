
<div class="modal fade" id="PaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalTitle">Registrar Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    <input type="hidden" class="budget_id" name="budget_id">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h4>Pendiente: <span class="pendingAmount"></span> <span class="currencyBudget"></span></label>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Método de Pago</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="">Seleccione un método</option>
                                @foreach ($paymentMethods as $paymentMethod)
                                    <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Moneda</label>
                            <select class="form-select" id="currency" name="currency" required>
                                <option value="">Seleccione una moneda</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Tasa del Dólar</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span> 
                                <input type="number" class="form-control" id="dollar_rate" name="dollar_rate" value="{{ $dollarRate->rate }}" required readonly>
                                <input type="hidden" class="form-control" id="dollar_rate_id" name="dollar_rate_id" value="{{ $dollarRate->id }}">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Monto USD</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="amount" name="amount" required min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Monto ARS</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="amount_ars" name="amount_ars" required min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Concepto</label>
                            <textarea class="form-control" id="concept" name="concept" rows="3" required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="savePayment" data-id="">Guardar Pago</button>
            </div>
        </div>
    </div>
</div>