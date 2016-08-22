<!DOCTYPE html>
<html>
<head>
    <title>
        Andre Reisinger
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Con tu compromiso, junto al de miles de voluntarios de todo el país, pondremos en agenda la construcción de un país más justo e inclusivo. INVITÁ UN AMIGO.">
    <meta name="author" content="AV">
    <meta name="Keywords"
          content="colecta, techo, un techo para mi pais, pa&iacute;s, pobreza, septiembre, setiembre, anotate, voluntarios, voluntario, ciudadano, asentamientos"/>
    <meta name="Robots" content="all"/>
    <meta http-equiv="Content-Language" content="es"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!--fb-->
    <meta property="og:url" content="http://colecta.techo.org.ar/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Andre Reisinger"/>
    <meta property="og:description"
          content="Juntos podemos superar la pobreza. Anotate como voluntario o doná a la #ColectaTECHO http://techo.org.ar/colecta"/>
    <meta property="og:image" content="{!! asset('img/front/_fbimg.jpg') !!}"/>
    <!--tw-->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@"/>
    <meta name="twitter:title" content="Andre Reisinger"/>
    <meta name="twitter:description"
          content="Juntos podemos superar la pobreza. Anotate como voluntario o doná a la #ColectaTECHO http://techo.org.ar/colecta"/>
    <meta name="twitter:image"
          content="{!! asset('img/front/_fbimg.jpg') !!}"/>

    <link href="{!! asset('favicon.ico') !!}" type="image/x-icon" rel="icon"/>
    <link href="{!! asset('favicon.ico') !!}" type="image/x-icon" rel="shortcut icon"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/app.min.css') !!}"/>
    <script type="text/javascript" src="{!! asset('js/main.min.js') !!}"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{!! asset('js/respond.min.js') !!}"></script>
    <![endif]-->
</head>
<body>
@section('main')
    @yield('content')
@show
</body>
</html>

