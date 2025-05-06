@extends('layouts.app')
@section('title', 'Comitente - Crear')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Crear Comitente</h5>

                        <a href="{{ route('client.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>


                    <div class="card-body">
                        <form id="formTask" class="needs-validation" action="{{ route('client.store') }}" method="POST">
                            @csrf
                            <div class="row gy-5 mb-3">
                                <div class="col-md-4" >
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="nombre"
                                            name="nombre"
                                            class="form-control @if($errors->has('nombre')) is-invalid @endif"
                                            placeholder="Ingrese Nombre"
                                            value="{{ old('nombre') }}"
                                        />
                                        <label for="code">Nombre</label>
                                        @if($errors->has('nombre'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nombre') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="apellido"
                                            name="apellido"
                                            class="form-control @if($errors->has('apellido')) is-invalid @endif"
                                            placeholder="Ingrese Apellido"
                                            value="{{ old('apellido') }}"
                                        />
                                        <label for="code">Apellido</label>

                                        @if($errors->has('apellido'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('apellido') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="email"
                                            id="correo"
                                            name="correo"
                                            class="form-control @if($errors->has('correo')) is-invalid @endif"
                                            placeholder="Ingrese Correo"
                                            value="{{ old('correo') }}"
                                        />
                                        <label for="code">Correo</label>

                                        @if($errors->has('correo'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('correo') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="telefono"
                                            name="telefono"
                                            class="form-control @if($errors->has('telefono')) is-invalid @endif"
                                            placeholder="Ingrese Telefono"
                                            value="{{ old('telefono') }}"
                                            maxlength="10"

                                        />
                                        <label for="code">Teléfono</label>

                                        @if($errors->has('telefono'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('telefono') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="provincia"
                                            name="provincia"
                                            class="form-control @if($errors->has('provincia')) is-invalid @endif"
                                            placeholder="Ingrese Provincia"
                                            value="{{ old('provincia') }}"
                                        />
                                        <label for="code">Provincia</label>

                                        @if($errors->has('provincia'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('provincia') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="domicilio"
                                            name="domicilio"
                                            class="form-control @if($errors->has('domicilio')) is-invalid @endif"
                                            placeholder="Ingrese Domicilio"
                                            value="{{ old('domicilio') }}"
                                        />
                                        <label for="code">Domicilio</label>

                                        @if($errors->has('domicilio'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('domicilio') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="localidad"
                                            name="localidad"
                                            class="form-control @if($errors->has('localidad')) is-invalid @endif"
                                            placeholder="Ingrese Localidad"
                                            value="{{ old('localidad') }}"
                                        />
                                        <label for="code">Localidad</label>

                                        @if($errors->has('localidad'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('localidad') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="row justify-content-end">
                                <div class="mt-3 mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary float-end">
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
@endsection
@section('scripts')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/clients.js?v=2') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
@endsection
