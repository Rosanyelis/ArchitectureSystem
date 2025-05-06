@extends('layouts.app')
@section('title', 'Presupuestos - Crear')
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
                    <h5 class="mb-0">Crear Ordenes de Compra de Materiales</h5>
                    <div>
                        <a href="{{ route('melted.index') }}" class="btn btn-sm btn-secondary"><i
                            class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>
                    
                </div>


                <div class="card-body">
                    <form id="formOrder" class="needs-validation" action="{{ route('melted.store') }}"
                        method="POST">
                        @csrf
                        
                        <div class="row gy-5 mb-3">
                        <h6>1. Datos de Cliente</h6>
                            <div class="col-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <select id="clients" name="client_id" style="padding: 0.1rem !important;"
                                        class="form-select form-select-sm select2 @if($errors->has('client_id')) is-invalid @endif"
                                        placeholder="Selecione Tipo de Cliente"
                                        data-allow-clear="true" data-placeholder="Selecione Tipo de Cliente"
                                        style="width: 100%">
                                        <option value="">-- Seleccionar --</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->cliente }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-icon  mt-2" 
                                data-bs-toggle="modal" data-bs-target="#AddClientModal">
                                    <i class="ri-add-box-fill ri-20px "></i>
                                </button>
                            </div>
                        </div>
                        <h6>2. Partidas</h6>
                        <div class="row gy-5 mb-3">
                            <div class=" col-lg-3 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <select id="melted" class="form-select">
                                        <option value="">-- Seleccionar --</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    <label for="melted">¿Fundido?</label>
                                </div>
                            </div>
                            <div class=" col-lg-3 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <select id="type_partida" class="form-select">
                                        <option value="">-- Seleccionar --</option>
                                        <option value="Gramos">Gramos</option>
                                        <option value="Pieza">Pieza</option>
                                    </select>
                                    <label for="type_partida">Tipo de Partida</label>
                                </div>
                            </div>
                        </div>
                        <h6>2.1. Detalles de Partidas</h6>
                        <div class="row gy-5 mb-3" id="partidaporfundir">
                            <div class=" col-lg-4 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <select
                                        class="material_id form-select select2"
                                        placeholder="Selecione Material">
                                        <option value="">-- Seleccionar --</option>
                                        @foreach($materials as $material)
                                            <option value="{{ $material->name }}">{{ $material->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="material_id">Material</label>
                                </div>
                            </div>
                            <div class=" col-lg-4 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <select class="type_product_id form-select select2"
                                        placeholder="Selecione tipo de producto">
                                        <option value="">-- Seleccionar --</option>
                                        @foreach($typeproducts as $type)
                                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="type_product_id">Tipo de Producto</label>
                                </div>
                            </div>
                            <div class=" col-lg-4 col-xl-4 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                        class="description form-control">
                                    <label for="description">Descripción</label>
                                </div>
                            </div>
                            <div class=" col-lg-2 col-xl-2 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <input type="number"
                                    class="net_weight form-control">
                                    <label for="net_weight">Peso Neto (gr)</label>
                                </div>
                            </div>
                            <div class=" col-lg-3 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <input type="number"
                                    class="agreed_weight form-control">
                                    <label for="agreed_weight">Precio Pactado por Gr. ($)</label>
                                </div>
                            </div>


                            <div class=" col-lg-3 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <button type="button" id=""
                                class="btn btn-secondary mt-3 text-center add-item-porfundir">Agregar
                                Partida</button>
                            </div>
                        </div>
                        <div class="row gy-5 mb-3" id="partidasinfundir">
                            <div class=" col-lg-4 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <select id="material_id"
                                        class=" form-select select2"
                                        placeholder="Selecione Material">
                                        <option value="">-- Seleccionar --</option>
                                        @foreach($materials as $material)
                                            <option value="{{ $material->name }}">{{ $material->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="material_id">Material</label>
                                </div>
                            </div>
                            <div class=" col-lg-4 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <select id="type_product_id" class=" form-select select2"
                                        placeholder="Selecione tipo de producto">
                                        <option value="">-- Seleccionar --</option>
                                        @foreach($typeproducts as $type)
                                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="type_product_id">Tipo de Producto</label>
                                </div>
                            </div>
                            <div class=" col-lg-4 col-xl-4 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <input id="description" type="text"
                                        class="description form-control">
                                    <label for="description">Descripción</label>
                                </div>
                            </div>
                            <div class=" col-lg-2 col-xl-2 col-md-2 col-sm-6 mb-0">
                                <div  class="form-floating form-floating-outline">
                                    <input type="number" id="cantidad"
                                    class="form-control" value="1">
                                    <label for="cantidad">Cantidad</label>
                                </div>
                            </div>
                            <div class=" col-lg-3 col-xl-2 col-md-3 col-sm-6 mb-0">
                                <div  class="form-floating form-floating-outline">
                                    <input type="number" id="net_weight"
                                    class="form-control">
                                    <label for="net_weight">Peso Neto (gr)</label>
                                </div>
                            </div>
                            
                            <div class=" col-lg-3 col-xl-2 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                    class="form-control legal_content"
                                    value="">
                                    <label for="legal_content">Contenido Ley</label>
                                </div>
                            </div>
                            <div class=" col-lg-3 col-xl-3 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="agreed_weight"
                                    class="form-control">
                                    <label for="agreed_weight">Precio Pactado por Gr. ($)</label>
                                </div>
                            </div>
                            <div class=" col-lg-2 col-xl-2 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <input  type="text" id="fine_gold_weight"
                                    class="form-control" readonly>
                                    <label for="fine_gold_weight">Peso de Oro Fino (Gr.)</label>
                                </div>
                            </div>

                            <div class=" col-lg-3 col-xl-2 col-md-3 col-sm-6 mb-0">
                                <div class="form-floating form-floating-outline">
                                    <input type="text"
                                    class="form-control total_amount"
                                    value="" readonly>
                                    <label for="total_amount">Total ($)</label>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class=" col-lg-12 col-xl-12 col-md-12 col-sm-12 mb-0 d-flex justify-content-end">
                                <button type="button"  class="btn btn-secondary text-center add-item-sinfundir">Agregar
                                Partida</button>
                            </div>
                        </div>
                        <div class="row gy-5 mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive text-nowrap">
                                    <table id="tablePartida" class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Material</th>
                                                <th scope="col">Tipo de Producto</th>
                                                <th scope="col">Tipo de Partida</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Peso Neto (gr)</th>
                                                <th scope="col">Precio Pactado ($)</th>
                                                <th scope="col">¿Fundido?</th>
                                                <th scope="col">Contenido Ley</th>
                                                <th scope="col">Contenido Fino</th>
                                                <th scope="col">Total a Pagar($)</th>
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
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('melted.partials.modal-addclient')
@endsection
@section('scripts')
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}">
</script>
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
<!-- Page JS -->
<script src="{{ asset('assets/js/forms-selects.js') }}"></script>
<script src="{{ asset('pagesjs/orders.js') }}"></script>

@endsection
