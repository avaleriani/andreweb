@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Importar excel de usuarios</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url'=> route('importUserStore'), 'method'=>'POST', 'files'=>true)) !!}
        <div class="group">
            {!! Form::file('excelFile') !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> </label>
        </div>
        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop