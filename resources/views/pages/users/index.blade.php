@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Usuarios', 'route' => 'admin.users.create', 'new' => 'Nuevo usuario'])
                @include('components.searchbox',[$busqueda, 'clean' => true])
                <div class="panel-body">
                    <div id="grid">
                        <div class="sui-gridheader">
                            <table class="sui-table order-table table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell">@sortablelink('id', 'Id')</th>
                                    <th class="sui-headercell">@sortablelink('nombre', 'Nombre')</th>
                                    <th class="sui-headercell">@sortablelink('username', 'Dni')</th>
                                    <th class="sui-headercell">@sortablelink('email', 'Email')</th>
                                    <th class="sui-headercell">@sortablelink('role', 'Rol')</th>
                                    <th class="sui-headercell" data-field="Acciones"><a href="#"
                                                                                        class="sui-link">Acciones</a>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($users as $user)
                                    <tr class="sui-row">
                                        <td class="sui-cell id">{!! $user->id !!}</td>
                                        <td class="sui-cell">{!! $user->nombre !!}</td>
                                        <td class="sui-cell">{!! $user->username !!}</td>
                                        <td class="sui-cell">{!! $user->email !!}</td>
                                        <td class="sui-cell">{!! $roles[$user->role] !!}</td>
                                        <td class='actions'>
                                        <span class="btn-normal">
                                            <a href="{!! route("admin.users.edit" , $user->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </span>
                                            {!!  Form::open(array('url' => route('admin.users.destroy', $user->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar el usuario?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                            <span class="btn-normal">
                                                 <a data-toggle="popover"
                                                    title="Modifica los puntos asignados al usuario" data-trigger="hover"
                                                    href="{!! route('userPuntoIndex',$user->id) !!}">
                                                    <i class="fa fa-braille"></i>
                                            </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $users->appends(['busqueda' => $busqueda])->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop