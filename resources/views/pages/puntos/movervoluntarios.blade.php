@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <div class="error">Este punto tiene asociados {!! $cv !!} voluntarios, debe cambiar de punto esos voluntarios para poder borrarlos.</div>
    <h2>Mover todos los voluntarios de un punto a otro</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('moverVoluntariosSave'))) !!}

        <div class="group">
            <label for="punto_desde" class="used-select used"><i class="fa fa-arrow-right"></i>Punto origen</label>
            <select class="select" name="punto_desde" id="punto_desde">
                <option value="{!! $puntoDesde->id !!}" selected>{!! $puntoDesde->nombre !!} - {!! $puntoDesde->nombreMostrar !!}</option>
            </select>
        </div>
        @include('components.select', ['name' => 'Punto destino', 'formName' => 'punto_hasta', 'models' => $puntosHasta])

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}


    </div>
@stop