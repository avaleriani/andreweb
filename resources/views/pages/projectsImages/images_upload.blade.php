@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Imagenes del proyecto</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('admin.projects.storeImages'), 'id' => 'dropzone')) !!}

        <div class="dropzone-preview"></div>

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}

    </div>

@stop