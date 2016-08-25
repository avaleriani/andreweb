@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Agregar imagenes al proyecto</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('admin.projects.store'))) !!}

        <div class="group">
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label for="nombre"><i class="fa fa-arrow-right"></i> Nombre</label>
        </div>

        <div class="group">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Descripcion</label>
        </div>

        <div class="group">
            <div id="edit"></div>
        </div>

        <div class="group">
            {!! Form::text('client', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label for="nombre"><i class="fa fa-arrow-right"></i> Cliente</label>
        </div>

        <div class="group">
            {!! Form::text('dc', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label for="nombre"><i class="fa fa-arrow-right"></i> Diseño y concepto</label>
        </div>

        <div class="group">
            {!! Form::text('year', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label for="nombre"><i class="fa fa-arrow-right"></i> Año / fecha</label>
        </div>

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}

    </div>

@stop