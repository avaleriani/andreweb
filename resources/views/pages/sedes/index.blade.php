@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Sedes', 'route' => 'admin.sedes.create', 'new' => 'Nueva sede'])
                @include('components.searchbox',[$busqueda, 'clean' => true])
                <div class="panel-body">
                    <div id="grid">
                        <div class="sui-gridheader">
                            <table class="sui-table order-table table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell">@sortablelink('id', 'Id')</th>
                                    <th class="sui-headercell">@sortablelink('nombre', 'Nombre')</th>
                                    <th class="sui-headercell">@sortablelink('descripcion', 'Descripcion')</th>
                                    <th class="sui-headercell">@sortablelink('mail', 'Email')</th>
                                    <th class="sui-headercell">@sortablelink('meta', 'Meta')</th>
                                    <th class="sui-headercell">Provincia</th>
                                    <th class="sui-headercell" data-field="Acciones"><a href="#"
                                                                                        class="sui-link">Acciones</a>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($sedes as $sede)
                                    <tr class="sui-row">
                                        <td class="sui-cell id">{!! $sede->id !!}</td>
                                        <td class="sui-cell nombre">{!! $sede->nombre !!}</td>
                                        <td class="sui-cell calle">{!! $sede->descripcion !!}</td>
                                        <td class="sui-cell">{!! $sede->mail !!}</td>
                                        <td class="sui-cell">{!! $sede->meta !!}</td>
                                        <td class="sui-cell">{!! $sede->provincia->nombre !!}</td>
                                        <td class='actions'>
                                        <span class="btn-normal">
                                            <a href="{!! route("admin.sedes.edit" , $sede->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </span>
                                            {!!  Form::open(array('url' => route('admin.sedes.destroy', $sede->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar la sede?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $sedes->appends(['busqueda' => $busqueda])->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop