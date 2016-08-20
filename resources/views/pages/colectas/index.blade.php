@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Colectas', 'route' => 'colectaPaso1', 'new' => 'Nueva colecta'])
                <div class="panel-body">
                    <div id="grid">
                        <div class="sui-gridheader">
                            <table class="sui-table order-table table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell"><a
                                                href="{!! $colectas->appends(['sort' => 'id'])->links() !!}">Id</a>
                                    </th>
                                    <th class="sui-headercell"><a
                                                href="{!! $colectas->appends(['sort' => 'nombre'])->links() !!}">Nombre</a>
                                    </th>
                                    <th class="sui-headercell"><a
                                                href="{!!  $colectas->appends(['sort' => 'info'])->links() !!}">Info</a>
                                    </th>
                                    <th class="sui-headercell"><a
                                                href="{!! $colectas->appends(['sort' => 'fecha_inicio'])->links() !!}">Fecha inicio</a>
                                    </th>
                                    <th class="sui-headercell"><a
                                                href="{!! $colectas->appends(['sort' => 'fecha_cierre'])->links() !!}">Fecha fin</a>
                                    </th>
                                    <th class="sui-headercell"><a
                                                href="{!! $colectas->appends(['sort' => 'activa'])->links() !!}">Activa</a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($colectas as $exbt)
                                    <tr class="sui-row">
                                        <td class="sui-cell">{!! $exbt->id !!}</td>
                                        <td class="sui-cell">{!! $exbt->nombre !!}</td>
                                        <td class="sui-cell">{!! $exbt->info !!}</td>
                                        <td class="sui-cell">{!! $exbt->fecha_inicio !!}</td>
                                        <td class="sui-cell">{!! $exbt->fecha_cierre !!}</td>
                                        <td class="sui-cell">{!! $exbt->activa!!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $colectas->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop