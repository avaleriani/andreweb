<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - COLECTA {!! Session::get('year') !!}</title>
    <meta name="Robots" content="noindex"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Con tu compromiso, junto al de miles de voluntarios de todo el país, pondremos en agenda la construcción de un país más justo e inclusivo. INVITÁ UN AMIGO.">
    <meta name="author" content="AV">
    <meta name="Keywords"
          content="colecta, techo, un techo para mi pais, pa&iacute;s, pobreza, septiembre, setiembre, anotate, voluntarios, voluntario, ciudadano, asentamientos"/>
    <meta http-equiv="Content-Language" content="es"/>

    <meta name="_token" content="{{ csrf_token() }}"/>
    <link href="{!! asset('favicon.ico') !!}" type="image/x-icon" rel="icon"/>


    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/font-awesome.min.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/c3.min.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/jqvmap.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/offline.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/backoffice.css') !!}"/>


    <script type="text/javascript" src="{!! asset('js/admin/jquery.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/admin/d3.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/admin/c3.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/admin/jquery.vmap.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/admin/maps/jquery.vmap.argentina.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/admin/backoffice.js') !!}"></script>

    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div id="notificacion"></div>
<div id="wrapper">
    @if (Auth::check())
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/colecta/admin">
                    <div class="flag-country"><img src="{!! asset('img/arg.png') !!}" alt="banderola"/></div>
                    COLECTA {!! Session::get('year') !!} - TECHO
                </a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="active" class="nav navbar-nav side-nav">
                    @if (Session::get('menu')["1_home"])
                        <li class="{!! Request::is('admin/') ? 'selected' : '' !!}">
                            <a href="{!! route('adminIndex') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Dashboard
                            </a>
                        </li>
                    @endif
                    <li class="sep"></li>
                    @if (Session::get('menu')["2_puntos"])
                        <li class="{!! Request::is('admin/puntos') ? 'selected' : '' !!}">
                            <a href="{!! route('admin.puntos.index') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Puntos
                            </a>
                        </li>
                    @endif
                    @if (Session::get('menu')["3_zonas"])
                        <li class="{!! Request::is('admin/zonas') ? 'selected' : '' !!}">
                            <a href="{!! route('admin.zonas.index') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Zonas
                            </a>
                        </li>
                    @endif
                    @if (Session::get('menu')["4_ciudads"])
                        <li class="{!! Request::is('admin/ciudads') ? 'selected' : '' !!}">
                            <a href="{!! route('admin.ciudades.index') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Ciudades
                            </a>
                        </li>
                    @endif
                    @if (Session::get('menu')["5_sedes"])
                        <li class="{!! Request::is('admin/sedes') ? 'selected' : '' !!}">
                            <a href="{!! route('admin.sedes.index') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Sedes
                            </a>
                        </li>
                    @endif
                    @if(Session::get('menu')["5_voluntarios"])
                        <li class="sep"></li>
                        <li class="{!! Request::is('admin/voluntarios/index') ? 'selected' : '' !!}">
                            <a href="{!! route('admin.voluntarios.index') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Voluntarios
                            </a>
                        </li>
                    @endif
                    @if (Session::get('menu')["6_users"])
                        <li class="sep"></li>
                        <li class="{!! Request::is('admin/users/index') ? 'selected' : '' !!}">
                            <a href="{!! route('admin.users.index') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Usuarios
                            </a>
                        </li>
                    @endif
                    @if (Session::get('menu')["7_misvoluntarios"])
                        <li class="sep"></li>
                        <li class="{!! Request::is('/admin/voluntarios/misvoluntarios') ? 'selected' : '' !!}">
                            <a href="{!! route('misvoluntarios') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Mis Voluntarios
                            </a>
                        </li>
                    @endif
                    @if (Session::get('menu')["8_mismobile"])
                        <li class="{!! Request::is('/admin/voluntarios/mismobile') ? 'selected' : '' !!}">
                            <a href="{!! route('mismobile') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Mis Voluntarios (asistencia)
                            </a>
                        </li>
                    @endif
                    @if (Session::get('menu')["9_colecta"])
                        <li class="sep"></li>
                        <li class="{!! Request::is('admin/') ? 'selected' : '' !!}">
                            <a href="{!! route('colectas') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Colecta
                            </a>
                        </li>
                    @endif
                    @if (Session::get('menu')["10_import"])
                        <li class="{!! Request::is('admin/import_*') ? 'selected' : '' !!}">
                            <a href="{!! route('importIndex') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Importaciones
                            </a>
                        </li>
                    @endif
                    <li class="sep"></li>
                </ul>

                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="username">
                        Hola! {!! Auth::user()->nombre !!} - {!! Session::get('roles')[Auth::user()->role] !!}</li>
                    <li class="divider-vertical"></li>
                    <li>
                   <span class="logout">
                       @if(Auth::check())
                           <a href="{!! route('logout') !!}">Logout</a>
                           <i class=" fa fa-power-off"></i>
                       @else
                           <a href="{!! route('login') !!}">Login</a>
                       @endif
                    </span>
                    </li>
                </ul>
            </div>
        </nav>
    @endif

    <div id="page-wrapper">
        @section('main')
            @yield('content')
        @show
    </div>
</div>
</body>
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

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
</script>
</html>
