@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Editar Voluntario - {{ $voluntario->nombre }}</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {{ Form::model($voluntario, array('route' => array('admin.voluntarios.update', $voluntario->id), 'method' => 'PUT')) }}

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
<!--
        <div class="group">
            <label for="equipofijo_id" class="used-select"><i class="fa fa-arrow-right"></i>¿Participó de alguna
                actividad en TECHO? > Interés en sumarse al equipo fijo</label>
            <select class="select" name="equipofijo_id" id="equipofijo_id">
                <option value="" {{ $voluntario->equipofijo_id != 1 && $voluntario->equipofijo_id != 2 ? 'selected' : '' }} disabled></option>
                <option value="1" {{ $voluntario->equipofijo_id == 1 ? 'selected' : '' }}> Si</option>
                <option value="2" {{ $voluntario->equipofijo_id == 2 ? 'selected' : '' }}> No</option>
            </select>
        </div>
-->
        <div class="group">
            <label for="estado_id" class="used-select"><i
                        class="fa fa-arrow-right"></i>Estado</label>
            <select class="select" name="estado_id" id="estado_id">
                {{-- */$select = '';/* --}}
                @if (!isset($voluntario->estado_id))
                    {{-- */$select = 'selected';/* --}}
                @endif
                <option value="" {!! $select !!} disabled></option>
                {{-- */$select = '';/* --}}
                @foreach ($estados as $k => $estado)
                    @if (isset($voluntario->estado_id) && $voluntario->estado_id == $estado)
                        {{-- */$select = 'selected';/* --}}
                    @endif
                    {!! "<option " . $select . " value='" . $k . "'>" . $estado . "</option>" !!}
                    {{-- */$select = '';/* --}}
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