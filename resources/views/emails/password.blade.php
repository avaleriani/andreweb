<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title>Activa tu cuenta para la colecta techo!</title>
</head>
<body style="font-family:Arial, sans-serif; font-size: 12px;">
<h1><strong>&iexcl;Hola&nbsp;</strong>{!! $emailVars["nombre"]  !!}<strong>!</strong><br/>
    <br/>


    <br/>
</h1>

<p> Nombre de usuario: {!! $emailVars["username"]  !!}</p>

<p>Activa tu cuenta creando una contraseña en esta direccion:  <a href="{!! $emailVars["link"] !!}"
                                                           target="_blank">Aqu&iacute;</a><br/>
    <br/></p>

<h1 class="null" style="text-align: left;"><br/>
    <em>Un abrazo,</em><br/>
    <br/>
    Equipo de Colecta&nbsp;<br/>
    <br/>

    &nbsp;</h1>

</body>
</html>