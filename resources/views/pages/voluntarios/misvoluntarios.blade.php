@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-globe"></i>Mis voluntarios</h3>
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
                <div class="panel-body">
                    <div id="grid">
                        <div class="filtros filtros-mv">
                            <form id="misvoluntarios_form" action="{!! route('misvoluntarios') !!}" method="post">
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
                                                <option {!!  $idAsistencia === "0" ? $select1 : '' !!} value='0'>No
                                                    asistio
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="botones-filtro">
                                    <div class="btn-buscar"><input id="btn-filtrar" class="btn" type="submit"
                                                                   value="Filtrar"/></div>
                                    <div class="btn-buscar"><a class="btn" href="{!! route('misvoluntarios') !!}">Limpiar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('components.searchbox',[$busqueda])
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
                                <th class="sui-headercell">Sede</th>
                                <th class="sui-headercell">Zona</th>
                                <th class="sui-headercell">Punto</th>
                                <th class="sui-headercell" data-field="Acciones"><a href="#"
                                                                                    class="sui-link">Acciones</a></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($voluntarios as $voluntario)
                                <span>
                                <tr class="sui-row">
                                    <td class="sui-cell">{!! $voluntario->id !!}</td>
                                    <td class="sui-cell">{!! $voluntario->dni !!}</td>
                                    <td class="sui-cell">{!! $voluntario->nombre !!}</td>
                                    <td class="sui-cell">{!! $voluntario->apellido !!}</td>
                                    <td class="sui-cell">{!! $voluntario->email !!}</td>
                                    <td class="sui-cell">{!! $voluntario->telefono !!}</td>
                                    <td class="sui-cell">{!! $estadosVol[$voluntario->estado] !!}</td>
                                    <td class="sui-cell">{!! (count($voluntario->registros) > 0) ? $voluntario->registros()->first()->sede ? $voluntario->registros()->first()->sede->nombre : '' : ''!!}</td>
                                    <td class="sui-cell">{!! (count($voluntario->registros) > 0) ? $voluntario->registros()->first()->zona ? $voluntario->registros()->first()->zona->nombreMostrar : '' : '' !!}</td>
                                    <td class="sui-cell">{!! (count($voluntario->registros) > 0) ? $voluntario->registros()->first()->punto ? $voluntario->registros()->first()->punto->nombreMostrar : '' : '' !!}</td>
                                    <td class='actions'>
                                            <a href="#" onclick="verPuntos({!! $voluntario->id !!});">Ver puntos</a>
                                            <a href="#" onclick="enviarCorreoDatos({!! $voluntario->id !!});"><i
                                                        class="fa fa-envelope-o"></i></a>
                                    </td>
                                </tr>
                                    @if ($voluntario->registros() && count($voluntario->registros) > 0)
                                        <tr style="display: none" id="dias_punto_header_{!! $voluntario->id !!}"
                                            class="sui-columnheader puntos-header">
                                       <th class="sui-headercell" data-field="Id">Id</th>
                                       <th class="sui-headercell" data-field="sede">Sede</th>
                                       <th class="sui-headercell" data-field="ciudad">Ciudad</th>
                                       <th class="sui-headercell" data-field="Zona">Zona</th>
                                       <th class="sui-headercell" data-field="Punto">Punto</th>
                                       <th class="sui-headercell" data-field="dia">Dia</th>
                                       <th class="sui-headercell" data-field="estado">Estado</th>
                                       <th class="sui-headercell" data-field="estado">Cambiar Estado</th>

                                       <th class="sui-headercell" data-field="acciones"><a href="#"
                                                                                           class="sui-link">Asistió?</a>
                                       </th>
                                    </tr>
                                        @foreach ($voluntario->registros as $reg)
                                            <span>
                                       <tr style="display: none"
                                           class="sui-row puntos-inner dias_punto_{!! $voluntario->id !!}">
                                               <td class="sui-cell">{!! $reg->id !!}</td>
                                               <td class="sui-cell">{!! $reg->sede ? $reg->sede->nombre : ''!!}</td>
                                               <td class="sui-cell">{!! $reg->ciudad ? $reg->ciudad->nombreMostrar : '' !!}</td>
                                               <td class="sui-cell">{!! $reg->zona ? $reg->zona->nombreMostrar : '' !!}</td>
                                               <td class="sui-cell">{!! $reg->punto ? $reg->punto->nombreMostrar : '' !!}</td>
                                               <td class="sui-cell">{!! $reg->diaColecta ? $reg->diaColecta->nombre : '' !!}</td>
                                               <td class="sui-cell"
                                                   id="estado_text_{!! $reg->id !!}">{!! $estadosMV[$reg->estado] !!}</td>
                                               <td class="sui-cell">
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
                                                       <input id="dia_estado_{!! $reg->id !!}" type="checkbox"
                                                              class="estado"
                                                              value="{!! $reg->estado !!}"
                                                              name="{!! $nameEstado !!}" {!! $ckd1 !!}/>
                                                   </span>
                                               </td>
                                               <td class="sui-cell">
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
                                                       <input id="asistencia_{!! $reg->id !!}" type="checkbox"
                                                              class="asistencia"
                                                              value="{!! $reg->asistio !!}"
                                                              name="{!! $nameAsistio !!}" {!! $ckd !!}/>
                                                   </span>
                                               </td>
                                       </tr>
                                       </span>
                                        @endforeach
                                    @endif
                                </span>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $voluntarios->appends(['busqueda' => $busqueda])->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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

        //REGISTROS SHOW HIDE
        function verPuntos(id) {
            event.preventDefault();
            $(".puntos-inner").hide();
            $(".puntos-header").hide();
            $('.dias_punto_' + id).show();
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
                    url: '{!! route('saveEstado') !!}',
                    success: function (response) {
                        if (response.success == true) {
                            notificacion('success', response.message);
                            $("#estado_text_" + idReg2).text(texto);
                        } else {
                            notificacion('error', response.message);
                        }
                    }
                });
            }
        });

        //AJAX ESTADO FIN

        //AJAX ENVIO CORREO

        function enviarCorreoDatos(idVoluntario) {
            var idVol = idVoluntario;
            event.preventDefault();
            if (idVol) {
                if (confirm("¿Desea enviarle un correo al voluntario para que confirme sus datos?")) {
                    jQuery.ajax({
                        type: 'POST',
                        cache: false,
                        data: {
                            idVoluntario: idVol
                        },
                        dataType: 'json',
                        url: '{!! route('reenvioCorreo') !!}',
                        success: function (response) {
                            if (response.result.success == true) {
                                notificacion('success', response.result.mensaje);
                            } else {
                                notificacion('error', response.result.mensaje);
                            }

                        }
                    });
                }
                else {

                }
            }
        }
        //AJAX ENVIO CORREO FIN

    </script>
@stop