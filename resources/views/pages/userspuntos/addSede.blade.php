@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Asignar sede al usuario</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('userPuntoStoreSede', $user->id))) !!}

        <div class="group">
            {!! Form::text('nombre', $user->username, array('readonly', 'class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label for="nombre"><i class="fa fa-arrow-right"></i> Nombre</label>
        </div>

        @include('components.select', ['name' => 'Sede', 'formName' => 'sede_id', 'models' => $sedes])

        <input type="hidden" name="user_id" value="{!! $user->id !!}"/>

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop
