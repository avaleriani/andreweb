@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!!  Form::open(array('url' => route('voluntarioPuntoDestroyAll', $voluntarioId), 'class' => 'form-no-style'))  !!}
    {!! Form::hidden('_method', 'DELETE')  !!}
    <span class="btn-normal">
    {{Form::button('<a class="btn">Borrar todos los puntos del voluntario</a>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar todos los puntos del voluntario?')"))}}
    </span>
    {!! Form::close() !!}
    {!! Html::ul($errors->all()) !!}
    <a href="{!! route("voluntarioPuntoCreate", $voluntarioId) !!}" class="btn">+ Asignar punto al voluntario</a>
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => ' Puntos del voluntario'])
                <div class="panel-body">
                    <div id="grid">
                        <div class="sui-gridheader">
                            <table class="sui-table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell">@sortablelink('id', 'Id')</th>
                                    <th class="sui-headercell">@sortablelink('nombre', 'Nombre')</th>
                                    <th class="sui-headercell">Punto</th>
                                    <th class="sui-headercell">Zona</th>
                                    <th class="sui-headercell">Ciudad</th>
                                    <th class="sui-headercell">Sede</th>
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
                                        <td class="sui-cell">{!! $uPunto->nombre !!}</td>
                                        <td class="sui-cell">{!! $uPunto->punto->nombre !!}</td>
                                        <td class="sui-cell">{!! $uPunto->zona->nombre !!}</td>
                                        <td class="sui-cell">{!! $uPunto->ciudad->nombre !!}</td>
                                        <td class="sui-cell">{!! $uPunto->sede->nombre !!}</td>
                                        <td class="sui-cell">{!! $uPunto->diaColecta->nombre !!}</td>
                                        <td class='actions'>
                                            {!!  Form::open(array('url' => route('voluntarioPuntoDestroy', $uPunto->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar el punto del voluntario?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop