@extends('layouts.default')
@section('content')
    <section id="editar" class="container content-section text-center">
        <div class="row">
            <form id="form-editar-voluntario" method="POST" action="{!! route('savePasswordUser') !!}">
                <div class="editar-inner">
                    <div class="logoAnotate">
                        <span class="lAnotate">ACTIVA TU CUENTA</span>
                    </div>
                    @include('errors.message')
                    <div class="row error">
                        {!! Html::ul($errors->all()) !!}
                    </div>
                    <div class="input-fila">
                        <label for="password">CONTRASEÑA</label>
                        <input type="password" id="password" name="password" class="input-box" required>
                    </div>
                    <div class="input-fila">
                        <label for="password_confirm">REPETIR CONTRASEÑA</label>
                        <input type="password" id="password_confirm" name="password_confirm" class="input-box" required>
                    </div>

                </div>
                <div class="btn-save-voluntario">
                    <input type="submit" class="btn-save" id="sendForm" name="saveForm" value="ACTUALIZAR DATOS"/>
                </div>

                <input class="hidden" name="hash" id="hash" value="{!! $hash !!}"/>
                <input class="hidden" name="idUser" id="idUser"
                       value="{!! $user->id !!}"/>
            </form>
        </div>
    </section>

    <script>
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
