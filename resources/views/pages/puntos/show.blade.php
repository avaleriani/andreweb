@extends('layouts.admin')
@section('content')
    <div class="row">

        <div class="form-group">
            <label>Id</label>

            <p>{!! $punto->id !!}</p>
        </div>

        <div class="form-group">
            <label>Nombre</label>

            <p>{!! $punto->nombre !!}</p>
        </div>
        <div class="form-group">
            <label>Calle</label>

            <p>{!! $punto->calle !!}</p>
        </div>

        <div class="form-group">
            <label>Esquina</label>

            <p>{!! $punto->esquina !!}</p>
        </div>

        <div class="form-group">
            <label>Direccion</label>

            <p>{!! $punto->direccion!!}</p>
        </div>

        <div class="form-group">
            <label>Gps</label>

            <p>{!! $punto->gps !!}</p>
        </div>


        <div class="form-group">
            <label>Zona</label>

            <p>{!! $punto->zona->nombre !!}</p>
        </div>
    </div>
@stop