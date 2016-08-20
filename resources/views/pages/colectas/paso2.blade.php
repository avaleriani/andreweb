@extends('layouts.admin')
@section('content')
    @include('errors.message')
    @include('components.panel-heading', ['name' => 'Nueva Colecta'])
    <div>
        <div class="alert alert-danger nueva-colecta-advertencia">
            <p>Atención!</p>
            <p class="text-center">
                Ultima advertencia!
                Segui adelante solo si estas completamente seguro de dejar inaccesible la colecta actual y crear una nueva.
            </p>

        </div>
        <p class="text-center"><a href="{!! route("colectaCreate") !!}" class="btn btn-red">Continuar(PELIGRO!)</a></p>
    </div>
@stop