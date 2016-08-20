@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Voluntarios', 'route' => 'admin.voluntarios.create', 'new' => 'Nuevo voluntario'])
                @include('components.searchbox',[$busqueda, 'clean' => true])
                <div class="panel-body">
                    <div id="grid">
                        <div class="sui-gridheader">
                            <table class="sui-table order-table table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell">@sortablelink('id', 'Id')</th>
                                    <th class="sui-headercell">@sortablelink('dni', 'Dni')</th>
                                    <th class="sui-headercell">@sortablelink('nombre', 'Nombre')</th>
                                    <th class="sui-headercell">@sortablelink('apellido', 'Apellido')</th>
                                    <th class="sui-headercell">@sortablelink('email', 'Email')</th>
                                    <th class="sui-headercell">@sortablelink('telefono', 'Telefono')</th>
                                    <th class="sui-headercell">@sortablelink('estado', 'Estado')</th>
                                    <th class="sui-headercell" data-field="Acciones"><a href="#"
                                                                                        class="sui-link">Acciones</a>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($voluntarios as $voluntario)
                                    <tr class="sui-row">
                                        <td class="sui-cell">{!! $voluntario->id !!}</td>
                                        <td class="sui-cell">{!! $voluntario->dni !!}</td>
                                        <td class="sui-cell">{!! $voluntario->nombre !!}</td>
                                        <td class="sui-cell">{!! $voluntario->apellido !!}</td>
                                        <td class="sui-cell">{!! $voluntario->email!!}</td>
                                        <td class="sui-cell">{!! $voluntario->telefono!!}</td>
                                        <td class="sui-cell">{!! $estadosVoluntario[$voluntario->estado]!!}</td>
                                        <td class='actions'>
                                        <span class="btn-normal">
                                            <a href="{!! route("admin.voluntarios.edit" , $voluntario->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </span>
                                            {!!  Form::open(array('url' => route('admin.voluntarios.destroy', $voluntario->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar el voluntario?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                            <span class="btn-normal">
                                                <a data-toggle="popover"
                                                   title="Modifica los puntos asignados al voluntario" data-trigger="hover"
                                                   href="{!! route('voluntarioPuntoIndex',$voluntario->id) !!}">
                                                    <i class="fa fa-braille"></i>
                                            </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $voluntarios->appends(['busqueda' => $busqueda])->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop