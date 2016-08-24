@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Proyectos', 'route' => 'admin.projects.create', 'new' => 'Nuevo Proyecto'])
                @include('components.searchbox',[$busqueda, 'clean' => true])
                <div class="panel-body">
                    <div id="grid">
                        <div class="sui-gridheader">
                            <table class="sui-table order-table table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell">@sortablelink('id', 'Id')</th>
                                    <th class="sui-headercell">@sortablelink('name', 'Nombre')</th>
                                    <th class="sui-headercell">@sortablelink('username', 'Nombre de usuario')</th>
                                    <th class="sui-headercell">@sortablelink('email', 'Email')</th>
                                    <th class="sui-headercell">@sortablelink('role', 'Rol')</th>
                                    <th class="sui-headercell" data-field="Acciones"><a href="#"
                                                                                        class="sui-link">Acciones</a>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($projects as $project)
                                    <tr class="sui-row">
                                        <td class="sui-cell id">{!! $project->id !!}</td>
                                        <td class="sui-cell">{!! $project->name !!}</td>
                                        <td class="sui-cell">{!! $project->username !!}</td>
                                        <td class="sui-cell">{!! $project->email !!}</td>
                                        <td class="sui-cell">{!! $roles[$project->role] !!}</td>
                                        <td class='actions'>
                                        <span class="btn-normal">
                                            <a href="{!! route("admin.users.edit" , $project->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </span>
                                            {!!  Form::open(array('url' => route('admin.users.destroy', $project->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar el usuario?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $projects->appends(['busqueda' => $busqueda])->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop