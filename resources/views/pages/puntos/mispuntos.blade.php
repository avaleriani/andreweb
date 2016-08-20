@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <a href="{!! route("admin.puntos.create") !!}" class="btn">Mis Puntos</a>
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-globe"></i> Puntos</h3>
                </div>
                <div class="panel-body">
                    <div id="grid">
                        @if(Auth::user()->isAdmin())
                            <div class="filtros">
                                <form method="get" action="{!! route("admin.puntos.index") !!}" id="form_zonas">
                                    <div class="controles-filtros">
                                        <div class="filtro-uno filtro-zonas">
                                            <div class="group">
                                                <label class="lbl-select used-select"><i
                                                            class="fa fa-arrow-right"></i>Zona</label>
                                                <ul class="select select--generic">
                                                    <li value='null'> SELECCIONE</li>
                                                    {{-- */$select = '';/* --}}
                                                    @foreach ($zonas as $zona)
                                                        @if ($idZona == $zona->id)
                                                            {{-- */$select = 'data-selected="true"';/* --}}
                                                        @endif
                                                        {!! "<li " . $select . " value='" . $zona->id . "'>" . $zona->nombre . "</li>" !!}
                                                        {{-- */$select = '';/* --}}
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="zona_id" id="selectJs" class="zonas_filter"
                                                       value="{!! $idZona !!}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="botones-filtro">
                                        <div class="btn-buscar"><input id="btn-filtrar" class="btn" type="submit"/>
                                        </div>
                                        <div class="btn-buscar"><input id="btn-reiniciar" class="btn" type="reset"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="buscar-box">
                            <input type="search" class="light-table-filter" data-table="order-table"
                                   placeholder="Buscar">
                        </div>
                        <div class="sui-gridheader">
                            <table class="sui-table order-table table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell"
                                        data-field="Id"><a
                                                href="{!! $puntos->appends(['sort' => 'id'])->links() !!}">Id</a>
                                    </th>
                                    <th class="sui-headercell"
                                        data-field="Nro"><a
                                                href="{!! $puntos->appends(['sort' => 'nombre'])->links() !!}">Nombre</a>
                                    </th>
                                    <th class="sui-headercell"
                                        data-field="Nombre"><a
                                                href="{!! $puntos->appends(['sort' => 'calle'])->links() !!}">Calle</a>
                                    </th>
                                    <th class="sui-headercell"
                                        data-field="Nombre EN"><a
                                                href="{!! $puntos->appends(['sort' => 'esquina'])->links() !!}">Esquina</a>
                                    </th>
                                    <th class="sui-headercell"
                                        data-field="Fecha"><a
                                                href="{!! $puntos->appends(['sort' => 'direccion'])->links() !!}">Direccion</a>
                                    </th>
                                    <th class="sui-headercell"
                                        data-field="Fecha EN"><a
                                                href="{!! $puntos->appends(['sort' => 'gps'])->links() !!}">Gps</a></th>
                                    <th class="sui-headercell"
                                        data-field="zona"><a
                                                href="{!! $puntos->appends(['sort' => 'zona_id'])->links() !!}">Zona</a>
                                    </th>
                                    <th class="sui-headercell" data-field="Acciones"><a href="#"
                                                                                        class="sui-link">Acciones</a>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($puntos as $punto)
                                    <tr class="sui-row">
                                        <td class="sui-cell id">{!! $punto->id !!}</td>
                                        <td class="sui-cell nombre">{!! $punto->nombre !!}</td>
                                        <td class="sui-cell calle">{!! $punto->calle !!}</td>
                                        <td class="sui-cell">{!! $punto->esquina !!}</td>
                                        <td class="sui-cell">{!! $punto->direccion !!}</td>
                                        <td class="sui-cell">{!! $punto->gps !!}</td>
                                        <td class="sui-cell">{!! $punto->zona->nombre !!}</td>
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
                            {!! $puntos->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop