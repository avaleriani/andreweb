<!DOCTYPE html>
<html>
<head>
    <title>
        COLECTA TECHO {!! $year !!}
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
    <meta property="og:title" content="Colecta TECHO {!! $year !!}!"/>
    <meta property="og:description"
          content="Juntos podemos superar la pobreza. Anotate como voluntario o doná a la #ColectaTECHO http://techo.org.ar/colecta"/>
    <meta property="og:image" content="{!! asset('img/front/_fbimg.jpg') !!}"/>
    <!--tw-->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@techoarg"/>
    <meta name="twitter:title" content="Colecta TECHO - {!! $dias !!}"/>
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
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                document,'script','https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '579121888908254');
        fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=579121888908254&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->

</head>
<body id="page-top" data-spy="scroll">
<script> (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-34465558-13', 'auto');
    ga('send', 'pageview'); </script>

<script type="text/javascript">
    window.appData = {csrf_token: '{!! csrf_token() !!}'};
</script>
@section('main')
    @yield('content')
@show
</body>
</html>

