@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-globe"></i>Mis voluntarios mobile</h3>
                    <form action="{!! route("exportar") !!}">
                        <input type="hidden" name="sede_id" value="{!! $idSede !!}"/>
                        <input type="hidden" name="ciudad_id" value="{!! $idCiudad !!}"/>
                        <input type="hidden" name="zona_id" value="{!! $idZona !!}"/>
                        <input type="hidden" name="punto_id" value="{!! $idPunto !!}"/>
                        <input type="hidden" name="estado_id" value="{!! $idEstado !!}"/>
                        <input type="hidden" name="asistencia_id" value="{!! $idAsistencia !!}"/>
                        <button type="submit" class="btn btn-new">Exportar Voluntarios</button>
                    </form>
                </div>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div id="grid">
                        <div class="filtros filtros-mv">
                            <form id="misvoluntarios_form" action="{!! route('mismobile') !!}" method="post">
                                {!! Form::token() !!}
                                <div class="controles-filtros">
                                    <div class="filtro-uno filtro-sedes">
                                        @include('components.select', ['name' => 'Sede', 'formName' => 'sede_id', 'models' => $sedes, 'id' => $idSede])
                                    </div>
                                    <div class="filtro-uno filtro-ciudades">
                                        @include('components.select', ['name' => 'Ciudad', 'formName' => 'ciudad_id', 'models' => $ciudades, 'id' => $idCiudad])
                                    </div>
                                    <div class="filtro-uno filtro-zonas">
                                        @include('components.select', ['name' => 'Zona', 'formName' => 'zona_id', 'models' => $zonas, 'id' => $idZona])
                                    </div>
                                    <div class="filtro-uno filtro-puntos">
                                        @include('components.select', ['name' => 'Punto', 'formName' => 'punto_id', 'models' => $puntos, 'id' => $idPunto])
                                    </div>
                                    <div class="filtro-uno filtro-estado">
                                        <div class="group">
                                            <label for="estado_id"
                                                   class="used-select {!! ($idEstado === "0" || $idEstado === "1") ? 'used' : '' !!}"><i
                                                        class="fa fa-arrow-right"></i>Estado</label>
                                            <select class="select" name="estado_id" id="estado_id">
                                                {{-- */$select = '';/* --}}
                                                @if ($idEstado === "0" || $idEstado === "1")
                                                    {{-- */$select = 'selected';/* --}}
                                                    @else{
                                                    <option value="" selected disabled></option>
                                                @endif
                                                <option {!! $idEstado === "0" ? $select : '' !!} value='0'>Anotado
                                                </option>
                                                <option {!!  $idEstado === "1" ? $select : '' !!} value='1'>Confirmado
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="filtro-uno filtro-asistencia">
                                        <div class="group">
                                            <label for="estado_id"
                                                   class="used-select {!! ($idAsistencia === "0" || $idAsistencia === "1") ? 'used' : '' !!}"><i
                                                        class="fa fa-arrow-right"></i>Asistio</label>
                                            <select class="select" name="asistencia_id" id="asistencia_id">
                                                {{-- */$select1 = '';/* --}}
                                                @if ($idAsistencia === "0" || $idAsistencia === "1")
                                                    {{-- */$select1 = 'selected';/* --}}
                                                @else
                                                    <option value="" selected disabled></option>
                                                @endif
                                                <option {!! $idAsistencia === "1" ? $select1 : '' !!} value='1'>Asistio
                                                </option>
                                                <option {!!  $idAsistencia === "0" ? $select1 : '' !!} value='0'>No asistio
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="botones-filtro">
                                    <div class="btn-buscar"><input id="btn-filtrar" class="btn" type="submit"
                                                                   value="Filtrar"/></div>
                                    <div class="btn-buscar"><a class="btn" href="{!! route('mismobile') !!}">Limpiar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table col-sm-12 table-bordered table-striped ">
                                <thead>
                                <tr>
                                    <th>Voluntario</th>
                                    <th>Estado</th>
                                    <th>Asistencia</th>
                                </tr>
                                </thead>
                                <tbody>
                                <span>
                        @foreach($voluntarios as $voluntario)
                                        <tr>
                         <td>{!! $voluntario->dni !!} -
                             {!! $voluntario->nombreCompleto() !!}
                             - <a
                                     href="tel:{!! $voluntario->telefono !!}">{!! $voluntario->telefono !!}</a>
                        <span class="pregunta">   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<i class="fa fa-plus"></i>
                        <div class="pregunta-box toggle">
                        <br>
                        <span>¿Es parte de algun equipo?</span>

                        <form>
                            <div class="equipoparte">
                                <input type="radio" idVoluntario="{!! $voluntario->id !!}"
                                       autocomplete="off" class="equipofijoAjax" name="equipoF"
                                       value="si" {{ ($voluntario->equipofijo_id != null) ? 'checked="checked"' : '' }}>Si<br>
                                <input type="radio" idVoluntario="{!! $voluntario->id !!}"
                                       autocomplete="off" class="equipofijoAjax" name="equipoF"
                                       value="no" {{ ($voluntario->equipofijo_id == null) ? 'checked="checked"' : ''  }}>No
                            </div>
                        </form>
                        <span>Quiere sumarse a:</span>

                        <div class="maspreguntas">
                            <input type="checkbox" class="preguntasAjax" name="1_deteccion"
                                   idVoluntario="{!! $voluntario->id !!}"
                                   value="1" {{ (count($voluntario->equipoFijo) > 0 && $voluntario->equipoFijo->deteccion == 1) ? 'checked="checked"' : ''  }}>
                            *Deteccion<br>
                            <input type="checkbox" class="preguntasAjax" name="2_coordinacion"
                                   idVoluntario="{!! $voluntario->id !!}"
                                   value="2" {{ (count($voluntario->equipoFijo) > 0 && $voluntario->equipoFijo->coordinacion == 1) ? 'checked="checked"' : ''  }}>
                            *Coordinacion de mesa<br>
                            <input type="checkbox" class="preguntasAjax" name="3_emprendedores"
                                   idVoluntario="{!! $voluntario->id !!}"
                                   value="3" {{ (count($voluntario->equipoFijo) > 0 && $voluntario->equipoFijo->emprendedores == 1) ? 'checked="checked"' : ''  }}>
                            *Emprendedores<br>
                            <input type="checkbox" class="preguntasAjax" name="4_apoyo"
                                   idVoluntario="{!! $voluntario->id !!}"
                                   value="4" {{ (count($voluntario->equipoFijo) > 0 && $voluntario->equipoFijo->apoyo == 1) ? 'checked="checked"' : ''  }}>
                            *Apoyo escolar<br>
                            <input type="checkbox" class="preguntasAjax" name="5_oficios"
                                   idVoluntario="{!! $voluntario->id !!}"
                                   value="5" {{ (count($voluntario->equipoFijo) > 0 && $voluntario->equipoFijo->oficios == 1) ? 'checked="checked"' : ''  }}>
                            *Oficios<br>
                        </div>
                        <br>
                        </div>
                        </span>
                       </td>
                       </tr>
                                        @foreach ($voluntario->registros as $reg)
                                            <tr>
                            <td>
                                @if($reg->punto_id != 0)
                                    {!! $reg->punto->nombre !!}
                                @endif
                                -
                                <b>
                                @if($reg->dia_colecta_id != 0)
                                        {!! $reg->diaColecta->nombre !!}
                                    @endif
                                </b>
                            </td>
                            <td id="estado_text_{!! $reg->id !!}"><span
                                        class="estado_str">{!! $estadosMV[$reg->estado] !!}</span>
                                <span class="group-chbox">
                                                           @if ($reg->estado == 1)
                                        {{-- */$ckd1 = 'checked';/* --}}
                                    @else
                                        {{-- */$ckd1 = '';/* --}}
                                    @endif
                                    @if(isset($reg->estado) && $reg->estado != 0)
                                        {{-- */$nameEstado = 'dia_estado_' . $dias[$reg->dia_colecta_id]; /* --}}
                                    @else
                                        {{--*/ $nameEstado = 'vacio' . "_" . $reg->id /*--}}
                                    @endif
                                    <input id="{!! $reg->id !!}" type="checkbox" class="estado"
                                           value="{!! $reg->estado !!}"
                                           name="{!! $nameEstado !!}" {!! $ckd1 !!}/>
                                </span>
                            </td>
                            <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Asistio?
                                <span class="group-chbox">
                                                           @if ($reg->asistio == 1)
                                        {{-- */$ckd = 'checked';/* --}}
                                    @else
                                        {{-- */$ckd = '';/* --}}
                                    @endif
                                    @if(isset($reg->dia_colectas_id) && $reg->dia_colectas_id != 0)
                                        {{-- */$nameAsistio = 'dia_' . $dias[$reg->dia_colecta_id]; /* --}}
                                    @else
                                        {{--*/ $nameAsistio = 'vacio' . "_" . $reg->id /*--}}
                                    @endif
                                    <input id="{!! $reg->id !!}" type="checkbox" class="asistencia"
                                           value="{!! $reg->asistio !!}" name="{!! $nameAsistio !!}" {!! $ckd !!}/>
                                 </span>
                            </td>
                            </tr>
                                            @endforeach
                                            </tr>
                                        @endforeach
             </span>
                                </tbody>
                            </table>
                        </div>
                        {!! $voluntarios->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            //REGISTROS SHOW HIDE
            function verPuntos(id) {
                $(".puntos-inner").hide();
                $(".puntos-header").hide();
                event.preventDefault();
                $.each($("[id^=dias_punto_" + id + "_]"), function (index) {
                    $(this).show();
                });
                $("#dias_punto_header_" + id).show();
            }

            //REGISTROS SHOW HIDE FIN

            //AJAX ASISTENCIA
            $(".asistencia").on("click", function () {
                var idReg = false;
                var matches = $(this).attr("id").match(/\d+$/);
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
                        url: '{!! route("saveAsistencia") !!}',
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

            //AJAX ASISTENCIA FIN

            //AJAX ESTADO
            $(".estado").on("click", function () {
                var objText = $(this);
                var idReg2 = false;
                var matches2 = $(this).attr("id").match(/\d+$/);
                if (matches2) {
                    idReg2 = matches2[0];
                }
                var texto = 'Anotado';

                if ($(this).is(':checked') == true) {
                    texto = 'Confirmado';
                }
                if (idReg2) {
                    jQuery.ajax({
                        type: 'POST',
                        cache: false,
                        data: {
                            estado: $(this).is(':checked'),
                            idRegistro: idReg2
                        },
                        dataType: 'json',
                        url: '{!! route("saveEstado") !!}',
                        success: function (response) {
                            if (response.success == true) {
                                notificacion('success', response.message);
                                $("#estado_text_" + idReg2).find(".estado_str").text(texto);
                            } else {
                                notificacion('error', response.message);
                            }

                        }
                    });
                }
            });

            //AJAX ESTADO FIN

            //AJAX preguntas
            $(".preguntasAjax").change(function () {
                var value = $(this).val();
                jQuery.ajax({
                    type: 'POST',
                    cache: false,
                    data: {
                        valor: $(this).is(':checked'),
                        idVoluntario: $(this).attr("idVoluntario"),
                        tipoPregunta: $(this).attr("name").substring(0, 1)
                    },
                    dataType: 'json',
                    url: '{!! route("saveEquipoFijo") !!}',
                    success: function (response) {
                        if (response.success == true) {
                            notificacion('success', response.message);
                        } else {
                            notificacion('error', response.message);
                        }

                    }
                });
            })
            ;

            //AJAX preguntas FIN

            //AJAX equipofijo
            $(".equipofijoAjax").change(function () {
                var value = $(this).val();
                jQuery.ajax({
                    type: 'POST',
                    cache: false,
                    data: {
                        valor: $(this).val(),
                        idVoluntario: $(this).attr("idVoluntario")
                    },
                    dataType: 'json',
                    url: '{!! route("saveEquipoFijoSiNo") !!}',
                    success: function (response) {
                        if (response.success == true) {
                            notificacion('success', response.message);
                        } else {
                            notificacion('error', response.message);
                        }

                    }
                });
            })
            ;

            $(".fa-plus").click(function () {
                $(this).parent().find(".pregunta-box").toggle('slow',
                        function () {
                            if ($(this).is(':visible')) {
                                $(".toggle").css({opacity: 1});
                            } else if ($(this).is(':hidden')) {
                                $(".toggle").css({opacity: 0.6});
                            }
                        })
            });


            $(function () {
                var cSede = $('#sede_id');
                var cCiudad = $('#ciudad_id');
                var cZona = $('#zona_id');
                var cPunto = $('#punto_id');

                //al seleccionar sedes
                cSede.on('change', function () {
                    var id = $(this).val();
                    if (id != '' && id != null) {
                        jQuery.ajax({
                            type: 'POST',
                            cache: false,
                            data: {sede_id: id},
                            dataType: 'json',
                            url: '{!! route("getCiudades") !!}',
                            success: function (response) {
                                cCiudad.find("option").remove();
                                cZona.find("option").remove();
                                cPunto.find("option").remove();
                                if (response.success == true) {
                                    cCiudad.append($("<option selected disabled></option>"));
                                    $.each(response.ciudades, function (index, item) {
                                        cCiudad.append($("<option></option>").text(item.nombreMostrar).val(item.id));
                                    });
                                } else {
                                    notificacion('error', response.message);
                                }
                            }
                        });
                    }
                    return false;
                });

                //al seleccionar ciudad
                cCiudad.on('change', function () {
                    var id = $(this).val();
                    if (id != '' && id != null) {
                        jQuery.ajax({
                            type: 'POST',
                            cache: false,
                            data: {ciudad_id: id},
                            dataType: 'json',
                            url: ' {!! route("getZonas") !!}',
                            success: function (response) {
                                cZona.find("option").remove();
                                cPunto.find("option").remove();
                                if (response.success == true) {
                                    cZona.append($("<option selected disabled></option>"));
                                    $.each(response.zonas, function (index, item) {
                                        cZona.append($("<option></option>").text(item.nombreMostrar).val(item.id));
                                    });
                                } else {
                                    notificacion('error', response.message);
                                }
                            }
                        });
                    }
                    return false;
                });

                //al seleccionar zona
                cZona.on('change', function () {
                    var id = $(this).val();
                    if (id != '' && id != null) {
                        jQuery.ajax({
                            type: 'POST',
                            cache: false,
                            data: {zona_id: id},
                            dataType: 'json',
                            url: ' {!! route("getPuntos") !!}',
                            success: function (response) {
                                cPunto.find("option").remove();
                                if (response.success == true) {
                                    cPunto.append($("<option selected disabled></option>"));
                                    $.each(response.puntos, function (index, item) {
                                        cPunto.append($("<option></option>").text(item.nombreMostrar).val(item.id));
                                    });
                                } else {
                                    notificacion('error', response.message);
                                }
                            }
                        });
                    }
                    return false;
                });

                //boton reiniciar filtros
                $("#btn-reiniciar").on('click', function () {
                    cSede.find("option").remove();
                    cCiudad.find("option").remove();
                    cZona.find("option").remove();
                    cPunto.find("option").remove();
                    cSede.val(null);
                    cCiudad.val(null);
                    cZona.val(null);
                    cPunto.val(null);
                    $("#VoluntarioMisvoluntariosForm").submit();
                });
            });
            //boton reiniciar filtros fin


        });

        //AJAX preguntas FIN
    </script>
    <style>
        /*
    Generic Styling, for Desktops/Laptops
    */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #333;
            color: white;
            font-weight: bold;
        }

        td, th {
            padding: 6px;
            border: 1px solid #ccc;
            text-align: left;
        }

        /*
    Max width before this PARTICULAR table gets nasty
    This query will take effect for any screen smaller than 760px
    and also iPads specifically.
    */
        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
            }
        }

        .fa-plus {
            cursor: pointer;
        }

        .toggle {
            display: none;
        }
    </style>
@stop