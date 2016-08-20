@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Nuevo voluntario (carga manual)</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('admin.voluntarios.store'))) !!}

        <div class="group">
            {!! Form::text('dni', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Dni</label>
        </div>

        <div class="group">
            {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Nombre</label>
        </div>

        <div class="group">
            {!! Form::text('apellido', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Apellido</label>
        </div>
        <div class="group">
            {!! Form::email('email', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Email</label>
        </div>

        <div class="group">
            {!! Form::text('telefono', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Telefono</label>
        </div>

        <div class="group">
            {!! Form::date('fnac', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Fecha de nacimiento</label>
        </div>

        <!--<div class="group">
            <label for="equipofijo_id" class="used-select"><i class="fa fa-arrow-right"></i>¿Participó de alguna
                actividad en TECHO? > Interés en sumarse al equipo fijo</label>
            <select class="select" name="equipofijo_id" id="equipofijo_id">
                <option value="" selected disabled></option>
                <option value="1"> Si</option>
                <option value="2"> No</option>
            </select>
        </div>
        -->
        <div class="group">
            <label for="role" class="used-select"><i
                        class="fa fa-arrow-right"></i>Estado</label>
            <select class="select" name="estado" id="estado">
                <option value="" selected disabled></option>
                @foreach ($estados as $key => $estado)
                    <option value="{!! $key !!}"> {!! $estado !!}</option>
                @endforeach
            </select>
        </div>

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}

    </div>
@stop