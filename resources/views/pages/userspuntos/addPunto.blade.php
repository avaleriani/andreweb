@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Asignar punto al usuario</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('userPuntoStorePunto', $user->id))) !!}

        <div class="group">
            {!! Form::text('nombre', $user->username, array('readonly', 'class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label for="nombre"><i class="fa fa-arrow-right"></i> Nombre</label>
        </div>
        @include('components.select', ['name' => 'Punto', 'formName' => 'punto_id', 'models' => $puntos])
        <input type="hidden" name="user_id" value="{!! $user->id !!}"/>


        <div class="group-chbox">
            {!! Form::checkbox('viernes', null, null, array('class' => 'left-form')) !!}
            <label><i class="fa fa-arrow-right"></i> Viernes</label>
        </div>
        <div class="group-chbox">
            {!! Form::checkbox('sabado', null, null, array('class' => 'left-form')) !!}
            <label><i class="fa fa-arrow-right"></i> Sabado</label>
        </div>
        <div class="group-chbox">
            {!! Form::checkbox('domingo', null, null, array('class' => 'left-form')) !!}
            <label><i class="fa fa-arrow-right"></i> Domingo</label>
        </div>
        <input type="hidden" name="user_id" value="{!! $user->id !!}"/>

    </div>

    <div class="btn-container">
        <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
        {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
    </div>
    {!! Form::close() !!}
@stop