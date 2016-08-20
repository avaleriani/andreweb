@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Zonas', 'route' => 'admin.zonas.create', 'new' => 'Nueva zona'])
                <div class="panel-body">
                    <div id="grid">
                        @if(Auth::user()->isAdmin())
                            <div class="filtros">
                                @include('components.searchbox',[$busqueda])
                                @include('components.filter', ['name' => 'Ciudad', 'formName' => 'ciudad_id', 'models' => $ciudades, 'id' => $idCiudad, 'action' => 'admin.zonas.index'])
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
                                    <th class="sui-headercell">@sortablelink('fb', 'Facebook')</th>
                                    <th class="sui-headercell">Ciudad</th>
                                    <th class="sui-headercell" data-field="Acciones"><a href="#"
                                                                                        class="sui-link">Acciones</a>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($zonas as $zona)
                                    <tr class="sui-row">
                                        <td class="sui-cell">{!! $zona->id !!}</td>
                                        <td class="sui-cell">{!! $zona->nombre !!}</td>
                                        <td class="sui-cell">{!! $zona->nombreMostrar !!}</td>
                                        <td class="sui-cell">{!! $zona->descripcion !!}</td>
                                        <td class="sui-cell">{!! $zona->fb !!}</td>
                                        <td class="sui-cell">{!! $zona->ciudad->nombreMostrar !!}</td>
                                        <td class='actions'>
                                        <span class="btn-normal">
                                            <a href="{!! route("admin.zonas.edit" , $zona->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </span>
                                            {!!  Form::open(array('url' => route('admin.zonas.destroy', $zona->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar la zona?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $zonas->appends(['busqueda' => $busqueda])->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop