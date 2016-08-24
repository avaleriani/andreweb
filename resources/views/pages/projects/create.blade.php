@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Nuevo Proyecto</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('admin.projects.store'), 'id' => 'dropzone-form-project')) !!}

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
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Email</label>
        </div>

        <div class="group">
            {!! Form::date('fnac', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Fecha de nacimiento</label>
        </div>

        <div class="dropzone-previws"></div>
        <div class="dropzone"></div>

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}

    </div>
    <script>
        $(function() {
            $('#edit').froalaEditor()
        });
    </script>
@stop