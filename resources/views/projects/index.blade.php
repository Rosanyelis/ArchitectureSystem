@extends('layouts.app')
@section('title', 'Proyectos')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Ajax Sourced Server-side -->
    <div class="card">
        <div class="card-header header-elements border-bottom">
            <h5 class="mb-0 me-2">Proyectos</h5>

            <div class="card-header-elements ms-auto">
                <a href="{{ route('project.create') }}" class="btn btn-sm btn-primary"
                >Crear Proyecto</a>
            </div>
        </div>
        <div class="card-datatable text-nowrap">
            <table id="projectsTable" class="datatables table table-sm">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Imagen</th>
                        <th>Proyecto</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Comitente</th>
                        <th>Total Presupuestado</th>
                        <th>Estatus de Permisos</th>
                        <th>Estatus de Proyecto</th>
                        <th>Estatus de Pagos</th>
                        <th style="width: 10px"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Ajax Sourced Server-side -->
    
    <!-- Modal ver cotización-->
    
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/projects/list-projects.js') }}"></script>
@endsection
