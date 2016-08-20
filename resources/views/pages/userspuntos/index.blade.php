@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    @if ($role == 1 || $role == 2)
        <a class="btn" href="{!! route("userPuntoCreatePunto",$userId)!!}">+ Asignar punto al usuario</a>
        <a class="btn" href="{!! route("userPuntoCreateZona",$userId)!!}">+ Asignar zona al usuario</a>
        <a class="btn" href="{!! route("userPuntoCreateCiudad",$userId)!!}">+ Asignar ciudad al usuario</a>
        <a class="btn" href="{!! route("userPuntoCreateSede",$userId)!!}">+ Asignar sede al usuario</a>
    @elseif ($role == 3)
        <a class="btn" href="{!! route("userPuntoCreatePunto",$userId)!!}">+ Asignar punto al usuario</a>
        <a class="btn" href="{!! route("userPuntoCreateZona",$userId)!!}">+ Asignar zona al usuario</a>
    @elseif($role == 4)
        <a class="btn" href="{!! route("userPuntoCreatePunto",$userId)!!}">+ Asignar punto al usuario</a>
    @endif
    {!!  Form::open(array('url' => route('userPuntoDestroyAll', $userId), 'class' => 'form-no-style'))  !!}
    {!! Form::hidden('_method', 'DELETE')  !!}
    <span class="btn-normal">
        {{Form::button('<a class="btn">Borrar todos los puntos del usuario</a>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar todos los puntos del usuario?')"))}}
    </span>
    {!! Form::close() !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Puntos del usuario'])
                <div class="panel-body">
                    <div id="grid">
                        <div class="sui-gridheader">
                            <table class="sui-table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell">@sortablelink('id', 'Id')</th>
                                    <th class="sui-headercell">@sortablelink('username', 'Nombre de usuario')</th>
                                    <th class="sui-headercell">Punto</th>
                                    <th class="sui-headercell">Dia</th>
                                    <th class="sui-headercell" data-field="Acciones"><a href="#"
                                                                                        class="sui-link">Acciones</a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($uPuntos as $uPunto)
                                    <tr class="sui-row">
                                        <td class="sui-cell">{!! $uPunto->id !!}</td>
                                        <td class="sui-cell">{!! $uPunto->user->username!!}</td>
                                        <td class="sui-cell">{!! $uPunto->punto->nombre !!}</td>
                                        <td class="sui-cell">{!! $uPunto->diaColecta ?  $uPunto->diaColecta->nombre : ''!!}</td>
                                        <td class='actions'>
                                            {!!  Form::open(array('url' => route('userPuntoDestroy', $uPunto->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar el punto del usuario?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $uPuntos->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
