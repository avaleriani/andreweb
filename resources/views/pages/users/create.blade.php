@extends('layouts.admin')
@section('content')
    @include('errors.message')
    <h2>Nuevo Usuario</h2>
    <div class="row">
        {!! Html::ul($errors->all()) !!}

        {!! Form::open(array('url' => route('admin.users.store'))) !!}

        <div class="group">
            {!! Form::text('nombre', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label for="nombre"><i class="fa fa-arrow-right"></i> Nombre</label>
        </div>

        <div class="group">
            {!! Form::text('username', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> DNI</label>
        </div>

        <div class="group">
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Email</label>
        </div>

        <div class="group">
            {!! Form::date('fnac', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Fecha de nacimiento</label>
        </div>

        <div class="group">
            {!! Form::password('password', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Password</label>
        </div>

        <div class="group">
            {!! Form::password('password_confirmation', null, array('class' => 'form-control')) !!}
            <span class="highlight"></span>
            <span class="bar"></span>
            <label><i class="fa fa-arrow-right"></i> Confirmar password</label>
        </div>

        <div class="group">
            <label for="role" class="used-select">
                <i class="fa fa-arrow-right"></i>Rol</label>
            {!! Form::select('role', $roles, null, array('placeholder' => '', 'class' => 'select')) !!}
        </div>

        <div class="btn-container">
            <a href="{{ URL::previous() }}" class="btn btn-red">Volver</a>
            {!! Form::submit('Guardar', array('class' => 'btn btn-blue')) !!}
        </div>
        {!! Form::close() !!}

    </div>
@stop