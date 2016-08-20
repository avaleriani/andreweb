@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Editar Punto - {{ $punto->nombre }}</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {{ Form::model($punto, array('route' => array('admin.puntos.update', $punto->id), 'method' => 'PUT')) }}

        <div class="group">
            {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Codigo</label>
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

        @include('components.select', ['name' => 'Zona', 'formName' => 'zona_id', 'models' => $zonas, 'id' => $punto->zona_id])

        <div class="group-chbox">
            {{-- */$checked1 = false;/* --}}
            @if ($punto->diaColecta->where('dia_colecta_id', 1)->first())
                {{-- */$checked1 = true;/* --}}
            @endif
            {!! Form::checkbox('viernes', null, $checked1, array('class' => 'left-form')) !!}
            <label><i class="fa fa-arrow-right"></i> Viernes</label>
        </div>
        <div class="group">
            @if ($pdc = $punto->diaColecta->where('dia_colecta_id', 1)->first())
                {!! Form::text('info_viernes', $pdc->informacion) !!}
            @else
                {!! Form::text('info_viernes') !!}
            @endif
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Informaci&oacute;n viernes</label>
        </div>

        <div class="group-chbox">
            {{-- */$checked2 = false;/* --}}
            @if ($punto->diaColecta->where('dia_colecta_id', 2)->first())
                {{-- */$checked2 = true;/* --}}
            @endif
            {!! Form::checkbox('sabado', null, $checked2, array('class' => 'left-form')) !!}
            <label><i class="fa fa-arrow-right"></i> Sabado</label>
        </div>

        <div class="group">
            @if ($pdc = $punto->diaColecta->where('dia_colecta_id', 2)->first())
                {!! Form::text('info_sabado', $pdc->informacion) !!}
            @else
                {!! Form::text('info_sabado') !!}
            @endif
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Informaci&oacute;n sabado</label>
        </div>

        <div class="group-chbox">
            {{-- */$checked3 = false;/* --}}
            @if ($punto->diaColecta->where('dia_colecta_id', 3)->first())
                {{-- */$checked3 = true;/* --}}
            @endif
            {!! Form::checkbox('domingo', null, $checked3, array('class' => 'left-form')) !!}
            <label><i class="fa fa-arrow-right"></i> Domingo</label>
        </div>

        <div class="group">
            @if ($pdc = $punto->diaColecta->where('dia_colecta_id', 3)->first())
                {!! Form::text('info_domingo', $pdc->informacion) !!}
            @else
                {!! Form::text('info_domingo') !!}
            @endif
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Informaci&oacute;n domingo</label>
        </div>


        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}

    </div>
@stop