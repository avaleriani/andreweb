@extends('layouts.login')
@section('content')
    <div class="container">
        <div id="login">
            <div id="inner-login">
                <h2>Accede para continuar</h2>
                <form id="login-form" method="post" action="{!! route('doLogin') !!}">
                    <p>
                    <div id="form-login-username" class="group">
                        {!! Form::text('username', null, array('class' => 'form-control', "size"=>"18",  "alt"=>"login", "required", "autofocus")) !!}
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label><i class="fa fa-arrow-right"></i> DNI</label>
                    </div>

                    <div id="form-login-password" class="group">
                        {!! Form::password('password', null, array('class' => 'form-control', "size"=>"18",  "alt"=>"login-p", "required")) !!}
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label><i class="fa fa-arrow-right"></i> Contraseña</label>
                    </div>

                    <div id="form-login-password" class="group">
                        <p>
                            <button type="submit" class="btn">Login</button>
                        </p>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if(Session::get('message') != null)
                        <p class="alert alert-login"><em> {!! Session::get('message') !!}</em></p>
                    @endif
                </form>
            </div>
        </div>

    </div>
@stop