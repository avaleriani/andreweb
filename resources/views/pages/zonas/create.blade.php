@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Nueva Zona</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('admin.zonas.store'))) !!}

        <div class="group">
            {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Codigo</label>
        </div>

        <div class="group">
            {!! Form::text('nombreMostrar', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Nombre</label>
        </div>

        <div class="group">
            {!! Form::text('descripcion', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Descripcion</label>
        </div>

        <div class="group">
            {!! Form::text('fb', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Facebook</label>
        </div>

        @include('components.select', ['name' => 'Ciudad', 'formName' => 'ciudad_id', 'models' => $ciudades])

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop