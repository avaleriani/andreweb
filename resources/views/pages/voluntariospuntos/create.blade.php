@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Asignar punto al voluntario</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('voluntarioPuntoStore', $voluntario->id))) !!}

        <div class="group">
            {!! Form::text('nombre', $voluntario->nombre, array('readonly', 'class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label for="nombre"><i class="fa fa-arrow-right"></i> Nombre</label>
        </div>

        @include('components.select', ['name' => 'Punto', 'formName' => 'punto_id', 'models' => $puntos])

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

        <input type="hidden" name="voluntario_id" value="{!! $voluntario->id !!}"/>

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}

    </div>
@stop
