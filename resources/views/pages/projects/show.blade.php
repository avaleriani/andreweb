@extends('layouts.admin')
@section('content')
    <div class="row">

    <div class="form-group">
        <label>Id</label>

        <p>{!! $user->id !!}</p>
    </div>

    <div class="form-group">
        <label>Nombre</label>

        <p>{!! $user->nombre !!}</p>
    </div>
    <div class="form-group">
        <label>Dni</label>

        <p>{!! $user->username !!}</p>
    </div>

    <div class="form-group">
        <label>Email</label>

        <p>{!! $user->email !!}</p>
    </div>

    <div class="form-group">
        <label>Creado</label>

        <p>{!! $user->created!!}</p>
    </div>
</div>
@stop
