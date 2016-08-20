@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Nueva Colecta</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('colectaStore'))) !!}

        <p class="aviso alert text-center">
         ATENCION!!
            Crear una nueva colecta archiva la anterior y hace los datos de esta inaccesibles desde el sistema.
        </p>

        <div class="group">
            {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Nombre</label>
        </div>

        <div class="group">
            {!! Form::text('info', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Info</label>
        </div>

        <div class="group">
            {!! Form::date('fecha_inicio', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Fecha inicio</label>
        </div>

        <div class="group">
            {!! Form::date('fecha_cierre', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Fecha cierre</label>
        </div>

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop