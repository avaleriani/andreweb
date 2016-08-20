<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - COLECTA</title>
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

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{!! asset('favicon.ico') !!}" type="image/x-icon" rel="icon"/>

    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/font-awesome.min.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/admin/backoffice.css') !!}"/>

    <script type="text/javascript" src="{!! asset('js/admin/jquery.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/admin/backoffice.js') !!}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@section('main')
    @yield('content')
@show
</body>
</html>