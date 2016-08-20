@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Importar datos desde excel'])
                <div class="panel-body">
                    <a href="{!! route("importZona") !!}" class="btn">Importar Zonas</a>
                    <a href="{!! route("importPunto") !!}" class="btn">Importar Puntos</a>
                    <a href="{!! route("importUser") !!}" class="btn">Importar Usuarios</a>
                </div>
                <div class="panel-body">
                    <a target="_blank" href="{!! route("downloadZonaExample") !!}" class="btn">Ejemplo Excel de Zonas</a>
                    <a target="_blank" href="{!! route("downloadPuntoExample") !!}" class="btn">Ejemplo Excel de Puntos</a>
                    <a target="_blank" href="{!! route("downloadUserExample") !!}" class="btn">Ejemplo Excel de Usuarios</a>
                </div>
                <h4 class="error">De los excel de ejemplo borrar todo menos la primer linea y cargar los nuevos datos.</h4>
            </div>
        </div>
    </div>
@stop