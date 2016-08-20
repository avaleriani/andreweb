@extends('layouts.default')
@section('content')
    <!-- Anotate -->
    <section id="editar" class="container content-section text-center">
        <div class="row">
            <form id="form-editar-voluntario" method="POST" action="{!! route('guardarEditar') !!}">
                <div class="editar-inner">
                    <div class="logoAnotate">
                        <span class="lAnotate">EDITA TUS DATOS</span>
                    </div>
                    <div class="input-fila">
                        <label for="nombre">NOMBRE</label>
                        <input type="text" id="nombre" name="nombre" class="input-box"
                               value="{!! $vol->nombre !!}">
                    </div>
                    <div class="input-fila">
                        <label for="apellido">APELLIDO</label>
                        <input type="text" id="apellido" name="apellido" class="input-box"
                               value="{!! $vol->apellido !!}">
                    </div>
                    <div class="input-fila">
                        <label for="fnac">FECHA DE NACIMIENTO</label>
                        <input type="text" id="fnac" name="fnac" class="input-box"
                               value="{!! $vol->fnac !!}">
                    </div>
                    <div class="input-fila">
                        <label for="dni">DNI</label>
                        <input type="text" id="dni" name="dni" class="input-box" disabled="disabled"
                               value="{!! $vol->dni !!}">
                    </div>
                    <div class="input-fila">
                        <label for="mail">MAIL</label>
                        <input type="email" id="email" name="email" class="input-box"
                               value="{!! $vol->email !!}">
                    </div>
                    <div class="input-fila">
                        <label for="telefono">TEL&Eacute;FONO</label>
                        <input type="text" id="telefono" name="telefono" class="input-box"
                               value="{!! $vol->telefono !!}">
                    </div>

                    <hr>

                    <div class="input-fila ciudad-select required">
                        <select class="sede-select" id="sede" name="sede">
                            <option value="null">SEDE</option>
                            @foreach ($sedes as $sede)
                                <option value='{!! $sede->id  !!}' {!! $idSede ==  $sede->id ? 'selected' : '' !!}>{!!  $sede->nombre !!} </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="expand-selects">
                        <div class="fila-dia dia-viernes"><label>Viernes</label></div>
                        <div class="input-fila select">
                            <select class="ciudad-select" id="ciudad1" name="ciudad1">
                                <option value="null">CIUDAD</option>
                                {{-- */$selectC1 = '';/* --}}
                                @foreach ($ciudadV as $ciudad)
                                    @if (!is_null($viernes))
                                        @if ($viernes->ciudad_id == $ciudad->id)
                                            {{-- */ $selectC1 = 'selected';/* --}}
                                        @endif
                                    @endif
                                    <option {!! $selectC1  !!} value='{!! $ciudad->id  !!}'>{!! $ciudad->nombre  !!}</option>
                                    {{-- */$selectC1 = '';/* --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="input-fila select">
                            <select class="zona-select" id="zona1" name="zona1">
                                <option value="null">ZONA</option>
                                {{-- */$selectZ1 = '';/* --}}
                                @foreach ($zonasV as $zona)
                                    @if (!is_null($viernes))
                                        @if ($viernes->zona_id == $zona->id)
                                            {{-- */ $selectZ1 = 'selected';/* --}}
                                        @endif
                                    @endif
                                    <option {!! $selectZ1  !!} value='{!! $zona->id  !!}'>{!! $zona->nombre  !!}</option>
                                    {{-- */$selectZ1 = '';/* --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="input-fila select">
                            <select id="punto1" name="punto1">
                                <option value="null">PUNTO</option>
                                {{-- */$selectP1 = '';/* --}}
                                @foreach ($puntosV as $punto)
                                    @if (!is_null($viernes))
                                        @if ($viernes->punto_id == $punto->id)
                                            {{-- */ $selectP1 = 'selected';/* --}}
                                        @endif
                                    @endif
                                    <option {!! $selectP1  !!} value='{!! $punto->id  !!}'>{!! $punto->nombre  !!}</option>
                                    {{-- */$selectP1 = '';/* --}}
                                @endforeach
                            </select>
                        </div>

                        <div class="fila-dia"><label>S&aacute;bado</label></div>
                        <div class="input-fila select">
                            <select class="ciudad-select" id="ciudad2" name="ciudad2">
                                <option value="null">CIUDAD</option>
                                {{-- */$selectC2 = '';/* --}}
                                @foreach ($ciudadV as $ciudad)
                                    @if (!is_null($sabado))
                                        @if ($sabado->ciudad_id == $ciudad->id)
                                            {{-- */ $selectC2 = 'selected';/* --}}
                                        @endif
                                    @endif
                                    <option {!! $selectC2  !!} value='{!! $ciudad->id  !!}'>{!! $ciudad->nombre  !!}</option>
                                    {{-- */$selectC2 = '';/* --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="input-fila select">
                            <select class="zona-select" id="zona2" name="zona2">
                                <option value="null">ZONA</option>
                                {{-- */$selectZ2 = '';/* --}}
                                @foreach ($zonasV as $zona)
                                    @if (!is_null($sabado))
                                        @if ($sabado->zona_id == $zona->id)
                                            {{-- */ $selectZ2 = 'selected';/* --}}
                                        @endif
                                    @endif
                                    <option {!! $selectZ2  !!} value='{!! $zona->id  !!}'>{!! $zona->nombre  !!}</option>
                                    {{-- */$selectZ2 = '';/* --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="input-fila select">
                            <select id="punto2" name="punto2">
                                <option value="null">PUNTO</option>
                                {{-- */$selectP2 = '';/* --}}
                                @foreach ($puntosV as $punto)
                                    @if (!is_null($sabado))
                                        @if ($sabado->punto_id == $punto->id)
                                            {{-- */ $selectP2 = 'selected';/* --}}
                                        @endif
                                    @endif
                                    <option {!! $selectP2  !!} value='{!! $punto->id  !!}'>{!! $punto->nombre  !!}</option>
                                    {{-- */$selectP2 = '';/* --}}
                                @endforeach
                            </select>
                        </div>

                        <div class="fila-dia"><label>Domingo</label></div>
                        <div class="input-fila select">
                            <select class="ciudad-select" id="ciudad3" name="ciudad3">
                                <option value="null">CIUDAD</option>
                                {{-- */$selectC3 = '';/* --}}
                                @foreach ($ciudadV as $ciudad)
                                    @if (!is_null($domingo))
                                        @if ($domingo->ciudad_id == $ciudad->id)
                                            {{-- */ $selectC3 = 'selected';/* --}}
                                        @endif
                                    @endif
                                    <option {!! $selectC3  !!} value='{!! $ciudad->id  !!}'>{!! $ciudad->nombre  !!}</option>
                                    {{-- */$selectC3 = '';/* --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="input-fila select">
                            <select class="zona-select" id="zona3" name="zona3">
                                <option value="null">ZONA</option>
                                {{-- */$selectZ3 = '';/* --}}
                                @foreach ($zonasV as $zona)
                                    @if (!is_null($domingo))
                                        @if ($domingo->zona_id == $zona->id)
                                            {{-- */ $selectZ3 = 'selected';/* --}}
                                        @endif
                                    @endif
                                    <option {!! $selectZ3  !!} value='{!! $zona->id  !!}'>{!! $zona->nombre  !!}</option>
                                    {{-- */$selectZ3 = '';/* --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="input-fila select">
                            <select id="punto3" name="punto3">
                                <option value="null">PUNTO</option>
                                {{-- */$selectP3 = '';/* --}}
                                @foreach ($puntosV as $punto)
                                    @if (!is_null($domingo))
                                        @if ($domingo->punto_id == $punto->id)
                                            {{-- */ $selectP3 = 'selected';/* --}}
                                        @endif
                                    @endif
                                    <option {!! $selectP3  !!} value='{!! $punto->id  !!}'>{!! $punto->nombre  !!}</option>
                                    {{-- */$selectP3 = '';/* --}}
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="btn-save-voluntario">
                        <input type="submit" class="btn-save" id="sendForm" name="saveForm" value="ACTUALIZAR DATOS"/>
                    </div>
                </div>
                <input class="hidden" name="hash" id="hash" value="{!! $hash !!}"/>
                <input class="hidden" name="idVoluntario" id="idVoluntario"
                       value="{!! $vol->id !!}"/>
            </form>
        </div>
    </section>

    <script>
        var ciudads = {!! $ciudades !!};
        var zonas = {!! $zonas !!};
        var puntos = {!! $puntos !!};

        var idSede = $('.sede-select').val();
        var ciudadesDeLaSede = ciudads[idSede];
        if (ciudadesDeLaSede) {
            for (i = 1; i <= 3; i++) {
                var contenedor = $("#ciudad" + i);
                contenedor.empty();
                contenedor.append('<option value="null">CIUDAD</option>');

                if (typeof ciudadesDeLaSede != 'undefined') {
                    $.each(ciudadesDeLaSede, function (index) {
                        contenedor.append('<option value="' + ciudadesDeLaSede[index].id + '">' + ciudadesDeLaSede[index].nombre + '</option>');
                    });
                }
            }
        }

        $("#ciudad1").val({!! $viernes ? $viernes->ciudad_id : '' !!});
        $("#ciudad2").val({!! $sabado ? $sabado->ciudad_id : ''  !!});
        $("#ciudad3").val({!! $domingo ? $domingo->ciudad_id : ''  !!});

        for (i = 1; i <= 3; i++) {

            var contenedor = $("#zona" + i);
            var idCiudad = $("#ciudad" + i).val();
            if (zonas[idCiudad] != undefined && zonas[idCiudad][i] != undefined) {
                var
                        zonasDeLaCiudad = zonas[idCiudad][i];

                contenedor.empty();
                contenedor.append('<option value="0">ZONA</option>');

                if (typeof zonasDeLaCiudad != 'undefined') {
                    $.each(zonasDeLaCiudad, function (index) {
                        contenedor.append('<option value="' + zonasDeLaCiudad[index].id + '">' + zonasDeLaCiudad[index].nombre + '</option>');
                    });
                }
            } else {
                contenedor.empty();
                contenedor.append('<option value="null">No hay</option>');
            }
        }

        $("#zona1").val({!! $viernes ? $viernes->zona_id : '' !!});
        $("#zona2").val({!! $sabado ? $sabado->zona_id : '' !!});
        $("#zona3").val({!! $domingo  ? $domingo->zona_id : '' !!});

        for (i = 1; i <= 3; i++) {
            var contenedor = $("#punto" + i);
            var idZona = $("#zona" + i).val();
            if (puntos[idZona] != undefined && puntos[idZona][i] != undefined) {
                var
                        puntosDeLaZona = puntos[idZona][i];

                contenedor.empty();
                contenedor.append('<option value="0">PUNTO</option>');

                if (typeof puntosDeLaZona != 'undefined') {
                    $.each(puntosDeLaZona, function (index) {
                        contenedor.append('<option value="' + puntosDeLaZona[index].id + '">' + puntosDeLaZona[index].nombre + '</option>');
                    });
                }
            } else {
                contenedor.empty();
                contenedor.append('<option value="null">No hay</option>');
            }
        }

        $("#punto1").val({!! $viernes ? $viernes->punto_id : ''!!});
        $("#punto2").val({!! $sabado ? $sabado->punto_id : '' !!});
        $("#punto3").val({!! $domingo ? $domingo->punto_id : '' !!});

        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-65615399-1', 'auto');
        ga('send', 'pageview');

    </script>
@stop
