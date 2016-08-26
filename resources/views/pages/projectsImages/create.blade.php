@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Agregar imagenes al proyecto</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('subirImagen'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone')) !!}

        <div class="dz-message">

        </div>

        <div class="fallback">
            <input name="file" type="file" multiple/>
        </div>

        <div class="dropzone-previews" id="dropzonePreview"></div>

        <h4 style="text-align: center;color:#428bca;">Click aqui o mueve las imagenes sobre el cuadrado blanco para subirlas al sitio
            y ordenarlas <span
                    class="glyphicon glyphicon-hand-down"></span></h4>

    {!! Form::hidden('csrf-token', csrf_token(), ['id' => 'csrf-token']) !!}
    {!! Form::hidden('project_id', $project->id, ['id' => 'project_id']) !!}
    {!! Form::close() !!}
        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
        </div>
    </div>

@stop