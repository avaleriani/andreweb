@extends('layouts.admin')
@section('content')
    @include('errors.message')
    @include('components.panel-heading', ['name' => 'Nueva Colecta'])
    <div>
        <div class="alert alert-danger nueva-colecta-advertencia">
            <p>Atención!</p>
            <p>Esta a punto de cerrar la colecta del año {!!   Session::get('year') !!}, esto significa que todos
                los datos, estadisticas, puntos, zonas, sedes, ciudades, etc quedaran inaccesibles y solo podra ser
                recuperada por un administrador.
                Solo si estas completamente seguro debes continuar
            </p>
        </div>
        <p class="text-center"> <a href="{!! route("colectaPaso2") !!}" class="btn btn-red">Continuar</a></p>
    </div>
@stop