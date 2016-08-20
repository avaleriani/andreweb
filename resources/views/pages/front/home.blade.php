@extends('layouts.default')
@section('content')
    @include('pages.front.components.header-nav')

    @include('pages.front.components.anotate')

    @include('pages.front.components.dona')

    @include('pages.front.components.quees')

    @include('pages.front.components.footer')

    @include('pages.front.components.modales')

    <script>
        var ciudads, zonas, puntos, saveUrl, saveUrlEditar;

        $(document).ready(function () {
            $.get("{!! route('listCiudades') !!}", function (json) {
                ciudads = JSON.parse(json);
            });
            $.get("{!! route('listZonas') !!}", function (json) {
                zonas = JSON.parse(json);
            });
            $.get("{!! route('listPuntos') !!}", function (json) {
                puntos =JSON.parse(json);
            });
            saveUrl = "{!! route('saveVoluntario') !!}";
            saveUrlEditar = "{!! route('editarVoluntario') !!}";

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

            borrarZonasPuntosInit();
        });
    </script>
@stop