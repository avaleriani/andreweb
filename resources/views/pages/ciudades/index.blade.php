@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}

    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Ciudades', 'route' => 'admin.ciudades.create', 'new' => 'Nueva ciudad'])
                <div class="panel-body">
                    <div id="grid">
                        @if(Auth::user()->isAdmin())
                            <div class="filtros">
                                @include('components.searchbox',[$busqueda])
                                @include('components.filter', ['name' => 'Sede', 'formName' => 'sede_id', 'models' => $sedes, 'id' => $idSede, 'action' => 'admin.ciudades.index'])
                            </div>
                        @endif
                        <div class="sui-gridheader">
                            <table class="sui-table order-table table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell">@sortablelink('id', 'Id')</th>
                                    <th class="sui-headercell">@sortablelink('nombre', 'Codigo')</th>
                                    <th class="sui-headercell">@sortablelink('nombreMostrar', 'Nombre')</th>
                                    <th class="sui-headercell">@sortablelink('descripcion', 'Descripcion')</th>
                                    <th class="sui-headercell">Sede</th>
                                    <th class="sui-headercell" data-field="Acciones"><a href="#" class="sui-link">Acciones</a>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($ciudades as $exbt)
                                    <tr class="sui-row">
                                        <td class="sui-cell">{!! $exbt->id !!}</td>
                                        <td class="sui-cell">{!! $exbt->nombre !!}</td>
                                        <td class="sui-cell">{!! $exbt->nombreMostrar !!}</td>
                                        <td class="sui-cell">{!! $exbt->descripcion !!}</td>
                                        <td class="sui-cell">{!! $exbt->sede ? $exbt->sede->nombre : '' !!}</td>
                                        <td class='actions'>
                                        <span class="btn-normal">
                                            <a href="{!! route("admin.ciudades.edit" , $exbt->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </span>
                                            {!!  Form::open(array('url' => route('admin.ciudades.destroy', $exbt->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar la ciudad?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $ciudades->appends(['busqueda' => $busqueda])->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop