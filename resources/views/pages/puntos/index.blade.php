@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Puntos', 'route' => 'admin.puntos.create', 'new' => 'Nuevo Punto'])
                <div class="panel-body">
                    <div id="grid">
                        @if(Auth::user()->isAdmin() || Auth::user()->isSede())
                            <div class="filtros">
                                @include('components.searchbox',[$busqueda])
                                @include('components.filter', ['name' => 'Zona', 'formName' => 'zona_id', 'models' => $zonas, 'id' => $idZona, 'action' => 'admin.puntos.index'])
                            </div>
                        @endif
                        <div class="sui-gridheader">
                            <table class="sui-table order-table table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell">@sortablelink('id', 'Id')</th>
                                    <th class="sui-headercell">@sortablelink('nombre', 'Codigo')</th>
                                    <th class="sui-headercell">@sortablelink('nombreMostrar', 'Nombre')</th>
                                    <th class="sui-headercell">@sortablelink('calle', 'Calle')</th>
                                    <th class="sui-headercell">@sortablelink('esquina', 'Esquina')</th>
                                    <th class="sui-headercell">@sortablelink('direccion', 'Direccion')</th>
                                    <th class="sui-headercell">@sortablelink('gps', 'Gps')</th>
                                    <th class="sui-headercell">Zona</th>
                                    <th class="sui-headercell" data-field="Acciones">
                                        <a href="#" class="sui-link">Acciones</a>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($puntos as $punto)
                                    <tr class="sui-row">
                                        <td class="sui-cell">{!! $punto->id !!}</td>
                                        <td class="sui-cell">{!! $punto->nombre !!}</td>
                                        <td class="sui-cell">{!! $punto->nombreMostrar !!}</td>
                                        <td class="sui-cell">{!! $punto->calle !!}</td>
                                        <td class="sui-cell">{!! $punto->esquina !!}</td>
                                        <td class="sui-cell">{!! $punto->direccion !!}</td>
                                        <td class="sui-cell">{!! $punto->gps !!}</td>
                                        <td class="sui-cell">{!! $punto->zona->nombreMostrar !!}</td>
                                        <td class='actions'>
                                        <span class="btn-normal">
                                            <a href="{!! route("admin.puntos.edit" , $punto->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </span>
                                            {!! Form::open(array('url' => route('admin.puntos.destroy', $punto->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar el punto?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $puntos->appends(['busqueda' => $busqueda])->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop