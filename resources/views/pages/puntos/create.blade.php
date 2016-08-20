@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Nuevo Punto</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('admin.puntos.store'))) !!}

        <div class="group">
            {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label for="nombre"><i class="fa fa-arrow-right"></i> Codigo</label>
        </div>

        <div class="group">
            {!! Form::text('nombreMostrar', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Nombre</label>
        </div>

        <div class="group">
            {!! Form::text('calle', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Calle</label>
        </div>

        <div class="group">
            {!! Form::text('esquina', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Esquina</label>
        </div>

        <div class="group">
            {!! Form::text('direccion', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Direccion (Punto exacto, esquina)</label>
        </div>

        <div class="group">
            {!! Form::text('gps', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Coordenadas GPS</label>
        </div>

        @include('components.select', ['name' => 'Zona', 'formName' => 'zona_id', 'models' => $zonas])

        <div class="group-chbox">
            {!! Form::checkbox('viernes', null, null, array('class' => 'left-form')) !!}
            <label><i class="fa fa-arrow-right"></i> Viernes</label>
        </div>
        <div class="group">
            {!! Form::text('info_viernes') !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Informaci&oacute;n viernes</label>
        </div>

        <div class="group-chbox">
            {!! Form::checkbox('sabado', null, null, array('class' => 'left-form')) !!}
            <label><i class="fa fa-arrow-right"></i> Sabado</label>
        </div>
        <div class="group">
            {!! Form::text('info_sabado') !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Informaci&oacute;n Sábado</label>
        </div>

        <div class="group-chbox">
            {!! Form::checkbox('domingo', null, null, array('class' => 'left-form')) !!}
            <label><i class="fa fa-arrow-right"></i> Domingo</label>
        </div>
        <div class="group">
            {!! Form::text('info_domingo') !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Informaci&oacute;n Domingo</label>
        </div>


        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}

    </div>
@stop