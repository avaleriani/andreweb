@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}

    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                @include('components.panel-heading', ['name' => 'Mis voluntarios asignados', 'route' => 'admin.voluntarios.create', 'new' => 'Registrar Voluntario'])
                <div class="panel-body">
                    <div id="grid">
                        @include('components.filter', ['name' => 'Punto', 'formName' => 'punto_id', 'models' => $puntos, 'id' => $idPunto, 'class' => 'puntos_filter', 'action' => 'adminIndex'])

                        <table class="sui-table order-table table">
                            <thead>
                            <tr class="sui-columnheader">
                                <th class="sui-headercell"
                                    data-field="nombre">Nombre
                                </th>
                                <th class="sui-headercell"
                                    data-field="punto">Punto
                                </th>
                                <th class="sui-headercell"
                                    data-field="dia">Dia
                                </th>
                                <th class="sui-headercell"
                                    data-field="estado">Estado
                                </th>
                                <th class="sui-headercell"
                                    data-field="asistio">Asistio
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($voluntarios as $vol)
                                <tr class="sui-row">
                                    <td class="sui-cell">
                                                <span
                                                        class="table-top">{!!$vol->dni . " - " . $vol->nom . ' '  . $vol->ape !!}</span>
                                        <span class="table-bottom"><a
                                                    href="tel:{!!$vol->tel  !!}">{!! $vol->tel !!}</a></span>
                                    </td>
                                    <td class="sui-cell">{!! $vol->pnom !!}</td>
                                    <td class="sui-cell">{!! $vol->dcnom !!}</td>
                                    <td class="sui-cell">{!!$estadosMV[$vol->estado]  !!}</td>
                                    <td class="sui-cell">
                                        <div class="group-chbox">
                                            {{-- */$checked2 = false;/* --}}
                                            @if ($vol->asistio == 1)
                                                {{-- */$checked2 = true;/* --}}
                                            @endif
                                            {!! Form::checkbox('dia_' . $vol->dcnom . "_" . $vol->rvid, null, $checked2, array('class' => 'asistencia')) !!}
                                        </div>
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
    <script>
        //Para jefe de punto
        $(function () {
            //AJAX ASISTENCIA
            $(".asistencia").on("click", function () {
                var idReg = false;
                var matches = $(this).attr("name").match(/\d+$/);
                if (matches) {
                    idReg = matches[0];
                }
                if (idReg) {
                    jQuery.ajax({
                        type: 'POST',
                        cache: false,
                        data: {
                            asistio: $(this).is(':checked'),
                            idRegistro: idReg
                        },
                        dataType: 'json',
                        url: '{!! route('saveAsistencia') !!}',
                        success: function (response) {
                            if (response.success == true) {
                                notificacion('success', response.message);
                            } else {
                                notificacion('error', response.message);
                            }

                        }
                    });
                }
            });
        });
        //AJAX ASISTENCIA FIN
    </script>
@stop