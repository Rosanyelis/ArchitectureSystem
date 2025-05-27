@extends('layouts.app')
@section('title', 'Presupuestos - Editar')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Editar Presupuesto</h5>
                    <div>
                        <a href="{{ route('budget.index') }}" class="btn btn-sm btn-secondary">
                            <i class="ri-arrow-left-line me-1"></i> Regresar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form id="formOrder" class="needs-validation" action="{{ route('budget.update', $budget->id) }}" method="POST" data-budget-id="{{ $budget->id }}">
                        @csrf
                        @method('PUT')
                        
                        <h6>1. Datos de Cliente</h6>
                        <div class="row gy-1 mb-1">
                            <div class="col-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <select id="clients" name="client_id" style="padding: 0.1rem !important;"
                                        class="form-select form-select-sm select2"
                                        placeholder="Selecione Tipo de Cliente"
                                        data-allow-clear="true" data-placeholder="Selecione Tipo de Cliente"
                                        style="width: 100%">
                                        <option value="">-- Seleccionar --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-icon mt-2" 
                                    data-bs-toggle="modal" data-bs-target="#AddClientModal">
                                    <i class="ri-add-box-fill ri-20px"></i>
                                </button>
                            </div>
                            <div class="col-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <select id="currency_id" name="currency_id" style="padding: 0.1rem !important;"
                                        class="form-select form-select-sm select2"
                                        placeholder="Selecione Moneda"
                                        data-allow-clear="true" data-placeholder="Selecione Moneda"
                                        style="width: 100%">
                                        <option value="">-- Seleccionar --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <h6>2. Detalles de Presupuestos</h6>
                        <div class="row gy-5 mb-3" id="partidaporfundir">
                            <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select select2" placeholder="Selecione tipo de presupuesto">
                                        <option value="">-- Seleccionar --</option>
                                        <option value="Presupuesto de Anteproyecto">Presupuesto de Anteproyecto</option>
                                        <option value="Presupuesto de Proyecto">Presupuesto de Proyecto</option>
                                        <option value="Presupuesto de Administración">Presupuesto de Administración</option>
                                        <option value="Presupuesto de Seguimiento de Obra">Presupuesto de Seguimiento de Obra</option>
                                        <option value="Total Honorarios Profesionales">Total Honorarios Profesionales</option>
                                    </select>
                                    <label for="">Tipos de Presupuestos</label>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="amount form-control">
                                    <label for="amount">Costo</label>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <button type="button" id="addBudget" class="btn btn-secondary mt-3 text-center">Agregar</button>
                            </div>
                        </div>
                        
                        <div class="row gy-5 mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive text-nowrap">
                                    <table id="tablePresupuesto" class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tipo de Presupuesto</th>
                                                <th scope="col">Costo</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="partidas" id="partidas_array">
                        <div class="row justify-content-end mt-5">
                            <div class="mb-3 col-md-3">
                                <button type="button" id="saveOrder" class="btn btn-primary float-end">
                                    <i class="ri-save-2-line me-1"></i>
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('budgets.partials.modal-create-customer') 
@endsection
@section('scripts')
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
<!-- Page JS -->
<script src="{{ asset('assets/js/forms-selects.js') }}"></script>
<script src="{{ asset('pagesjs/budgets/edit-budgets.js') }}"></script>
@endsection
