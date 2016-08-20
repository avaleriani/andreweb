@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="form-group">
            <label>Id</label>
            <p>{!! $zona->id !!}</p>
        </div>

        <div class="form-group">
            <label>Nombre</label>
            <p>{!! $zona->nombre !!}</p>
        </div>
        <div class="form-group">
            <label>Descripcion</label>
            <p>{!! $zona->descripcion !!}</p>
        </div>
        <div class="form-group">
            <label>Facebook</label>
            <p>{!! $zona->fb!!}</p>
        </div>

        <div class="form-group">
            <label>Ciudad</label>
            <p>{!! $zona->ciudad->nombre !!}</p>
        </div>

    </div>
@stop