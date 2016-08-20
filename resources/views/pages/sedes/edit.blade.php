@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Editar Sede - {{ $sede->nombre }}</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {{ Form::model($sede, array('route' => array('admin.sedes.update', $sede->id), 'method' => 'PUT')) }}

        <div class="group">
            {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
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
            {!! Form::email('mail', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Email</label>
        </div>

        <div class="group">
            {!! Form::text('meta', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Meta de Voluntarios</label>
        </div>

        @include('components.select', ['name' => 'Provincia', 'formName' => 'provincia_id', 'models' => $provincias, 'id' => $sede->provincia_id])

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop