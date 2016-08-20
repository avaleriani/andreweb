<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title>Tus nuevos puntos!</title>
</head>
<body style="font-family:Arial, sans-serif; font-size: 12px;">
<h1><strong>&iexcl;Hola&nbsp;</strong>{!! $emailVars["nombre"] !!}<strong>!</strong><br/>
    <p>Te queremos contar que hubo un problema con uno de los puntos que te registrarte y tuvimos que cambiarlo.

        Ac&aacute; te enviamos los puntos que tenes anotados ahora: </p>
    <table class="tftable" border="1"
           style="font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;">
        <tr>
            <th style="font-size: 12px;background-color: #acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;">
                Día
            </th>
            <th style="font-size: 12px;background-color: #acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;">
                Punto
            </th>
            <th style="font-size: 12px;background-color: #acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;">
                Zona
            </th>
            <th style="font-size: 12px;background-color: #acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;">
                Contacto
            </th>
        </tr>
        @if(isset($emailVars["tabla"]["Viernes"]))
            <tr style=" background-color: #ffffff;">
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                    Viernes
                </td>
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! $emailVars["tabla"]["Viernes"]["punto"] !!}</td>
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! $emailVars["tabla"]["Viernes"]["zona"] !!}</td>
                @if(isset($emailVars["tabla"]["Viernes"]["fb"]))
                    <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                        <a href="{!! $emailVars["tabla"]["Viernes"]["fb"] !!}"> FACEBOOK</a>
                    </td>
                @endif
            </tr>
        @endif
        @if(isset($emailVars["tabla"]["Sabado"]))
            <tr style=" background-color: #ffffff;">
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                    Sabado
                </td>
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! $emailVars["tabla"]["Sabado"]["punto"] !!}</td>
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! $emailVars["tabla"]["Sabado"]["zona"] !!}</td>
                @if(isset($emailVars["tabla"]["Sabado"]["fb"]))
                    <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                        <a href="{!! $emailVars["tabla"]["Sabado"]["fb"] !!}">FACEBOOK</a>
                    </td>
                @endif
            </tr>
        @endif
        @if(isset($emailVars["tabla"]["Domingo"]))
            <tr style=" background-color: #ffffff;">
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                    Domingo
                </td>
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! $emailVars["tabla"]["Domingo"]["punto"] !!}</td>
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! $emailVars["tabla"]["Domingo"]["zona"] !!}</td>
                @if(isset($emailVars["tabla"]["Domingo"]["fb"]))
                    <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                        <a href="{!! $emailVars["tabla"]["Domingo"]["fb"] !!}">FACEBOOK</a>
                    </td>
                @endif
            </tr>
        @endif
    </table>
    <h1 class="null" style="text-align: left;"><br/>
        <em>Un abrazo,</em><br/>
        <br/>
        Equipo de Colecta&nbsp;<br/>
        <br/>

        &nbsp;</h1>

</body>
</html>
