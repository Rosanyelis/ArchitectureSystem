@extends('layouts.app')
@section('title', 'Proyectos - Crear')
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
                    <h5 class="mb-0">Crear Proyecto</h5>
                    <div>
                        <a href="{{ route('project.index') }}" class="btn btn-sm btn-secondary"><i
                            class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>
                    
                </div>


                <div class="card-body">
                    <form id="formOrder" class="needs-validation" action="{{ route('project.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <h6>1. Datos de Cliente y Presupuesto relacionado al proyecto</h6>
                        <div class="row gy-1 mb-1">
                            <div class="col-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <select id="clients" name="customer_id" style="padding: 0.1rem !important;"
                                        class="form-select form-select-sm select2"
                                        placeholder="Selecione Cliente"
                                        data-allow-clear="true" data-placeholder="Selecione Cliente"
                                        style="width: 100%">
                                        <option value="">-- Seleccionar --</option>
                                        
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-4 mb-2">
                                <div class="form-floating form-floating-outline">
                                    <select id="budget_id" name="budget_id" style="padding: 0.1rem !important;"
                                        class="form-select form-select-sm select2"
                                        placeholder="Selecione Presupuesto"
                                        data-allow-clear="true" data-placeholder="Selecione Presupuesto"
                                        style="width: 100%">
                                        <option value="">-- Seleccionar --</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <h6>2. Detalles del Proyecto</h6>
                        <div class="row gy-5 mb-3" >
                            <div class="d-flex align-items-start align-items-sm-center gap-6">
                                <img src="{{ asset('assets/img/avatars/2.png') }}" alt="user-avatar" class="d-block w-px-200 h-px-200 rounded-4" id="uploadedAvatar">
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-3 mb-4 waves-effect waves-light" tabindex="0">
                                        <span class="d-none d-sm-block">Cargar Imagen de Proyecto</span>
                                        <i class="icon-base ri ri-upload-2-line d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" name="url_image" hidden="" accept="image/png, image/jpeg, image/jpg">
                                    </label>
                                    <button type="button" class="btn btn-outline-danger account-image-reset mb-4 waves-effect">
                                        <i class="icon-base ri ri-refresh-line d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>

                                    <div>formatos permitidos: JPG, JPEG, PNG. Peso máximo: 800K</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        id="name"
                                        name="name"
                                        placeholder="Ingrese nombre del proyecto"
                                        value="{{ old('name') }}"
                                        autofocus>
                                    <label for="name">Nombre del Proyecto</label>

                                    @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        type="date"
                                        class="form-control form-control-sm {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                                        id="start_date"
                                        name="start_date"
                                        placeholder="Ingrese fecha de inicio del proyecto"
                                        value="{{ old('start_date') }}"
                                        autofocus>
                                    <label for="name">Fecha de Inicio</label>
                                    
                                    @if($errors->has('start_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('start_date') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        type="date"
                                        class="form-control form-control-sm {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                                        id="end_date"
                                        name="end_date"
                                        placeholder="Ingrese fecha de fin del proyecto"
                                        value="{{ old('end_date') }}"
                                        autofocus>
                                    <label for="end_date">Fecha de Fin</label>
                                    @if($errors->has('end_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('end_date') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <textarea
                                        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                        id="description"    
                                        name="description"
                                        rows="6">{{ old('description') }}</textarea>

                                    <label for="description">Descripción</label>

                                    @if($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        class="form-control form-control-sm {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                        id="address"
                                        name="address"
                                        placeholder="Ingrese dirección del proyecto"
                                        value="{{ old('address') }}"
                                        autofocus>
                                    <label for="address">Dirección</label>
                                    @if($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        class="form-control form-control-sm {{ $errors->has('location') ? 'is-invalid' : '' }}"
                                        id="location"
                                        name="location"
                                        placeholder="Ingrese ubicación del proyecto"
                                        value="{{ old('location') }}"
                                        autofocus>
                                    <label for="location">Ubicación</label>
                                    @if($errors->has('location'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('location') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        class="form-control form-control-sm {{ $errors->has('province') ? 'is-invalid' : '' }}"
                                        id="province"
                                        name="province"
                                        placeholder="Ingrese provincia del proyecto"
                                        value="{{ old('province') }}"
                                        autofocus>
                                    <label for="province">Provincia</label>
                                    @if($errors->has('province'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('province') }}
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="row justify-content-end mt-5">
                            <div class="mb-3 col-md-3">
                                <button type="submit" id="saveOrder" class="btn btn-primary float-end">
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
<script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}">
</script>
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
<!-- Page JS -->
<script src="{{ asset('assets/js/forms-selects.js') }}"></script>
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
<script src="{{ asset('pagesjs/projects/form-projects.js') }}"></script>

@endsection
