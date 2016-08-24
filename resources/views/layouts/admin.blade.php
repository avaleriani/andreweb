<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Andre Reisinger}</title>
    <meta name="Robots" content="noindex"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Admin for Andre Reisinger web">
    <meta name="author" content="AV">
    <meta name="Keywords"
          content="admin, andre,reisinger"/>
    <meta http-equiv="Content-Language" content="es"/>

    <meta name="_token" content="{{ csrf_token() }}"/>
    <link href="{!! asset('favicon.ico') !!}" type="image/x-icon" rel="icon"/>

    <script type="text/javascript" src="{!! asset('js/admin/jquery.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/admin/dropzone.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/admin/wysiwyg.js') !!}"></script>
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
                    BACKOFFICE
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
                    @if (Session::get('menu')["2_projects"])
                        <li class="sep"></li>
                        <li class="{!! Request::is('admin/projects/index') ? 'selected' : '' !!}">
                            <a href="{!! route('admin.projects.index') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Proyectos
                            </a>
                        </li>
                    @endif
                    <li class="sep"></li>
                    @if (Session::get('menu')["3_users"])
                        <li class="sep"></li>
                        <li class="{!! Request::is('admin/users/index') ? 'selected' : '' !!}">
                            <a href="{!! route('admin.users.index') !!}">
                                <i class="fa  fa-angle-right"></i>
                                Usuarios
                            </a>
                        </li>
                    @endif
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
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/font-awesome.min.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/offline.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/basic.min.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/dropzone.min.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/wysiwyg.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/backoffice.css') !!}"/>

    <script>
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
        });
    </script>
</body>
</html>
