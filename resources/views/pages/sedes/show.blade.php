@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="form-group">
            <label>Id</label>

            <p>{!! $sede->id !!}</p>
        </div>

        <div class="form-group">
            <label>Nombre</label>

            <p>{!! $sede->nombre !!}</p>
        </div>
        <div class="form-group">
            <label>Descripcion</label>

            <p>{!! $sede->descripcion !!}</p>
        </div>

        <div class="form-group">
            <label>Mail</label>

            <p>{!! $sede->mail !!}</p>
        </div>

        <div class="form-group">
            <label>Meta de voluntarios</label>

            <p>{!! $sede->meta !!}</p>
        </div>

        <div class="form-group">
            <label>Provincia</label>

            <p>{!! $sede->provincia()->nombre !!}</p>
        </div>
    </div>
@stop