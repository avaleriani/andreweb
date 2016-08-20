<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title>Bienvenido a la Colecta!</title>
</head>
<body style="font-family:Arial, sans-serif; font-size: 12px;">
<h1>&iexcl;Hola&nbsp;{!! $emailVars["nombre"] !!}!<br/>
    <br/>
    <br/>
    <br/>
    <p style="color:#ff00ff">GRACIAS por participar de la #ColectaTECHO el 2, 3 y 4 de septiembre.&nbsp;</p>
    <br/>
    Llega el momento del año en que salimos a las calles, nos movilizamos y le contamos a toda la sociedad todo aquello
    que no están viendo…
    <br/>
    <br/>
    Queremos ser 11.000 voluntarios en las calles de más de 35 ciudades del país para trabajar junto a más familias que
    viven en asentamientos informales en situación de pobreza.
    Por eso:

    <br/>
    <a href="http://www.techo.org.ar/colecta/" target="_blank"><img align="none" height="114"
                                                                    src="https://gallery.mailchimp.com/e1e6f3ad0ecbaf71f74cd71dc/images/61a7b5e0-a2cc-49b4-9d33-64ba94484b5a.png"
                                                                    style="width: 696px; height: 114px; margin: 0px;"
                                                                    width="696"/></a></h1>


<p>Sumate al grupo de Facebook de tu zona para vivir la previa y recibir información.</p>
<table class="tftable" border="1"
       style="font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;">
    <tr>
        <th style="font-size: 12px;background-color: #009EE2;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;">
            Día
        </th>
        <th style="font-size: 12px;background-color: #009EE2;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;">
            Punto
        </th>
        <th style="font-size: 12px;background-color: #009EE2;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;">
            Mas informaci&oacute;n
        </th>
        <th style="font-size: 12px;background-color: #009EE2;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;">
            Zona
        </th>
        <!--<th style="font-size: 12px;background-color: #009EE2;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;"
            >Encargado de zona
        </th>
        -->
        <th style="font-size: 12px;background-color: #009EE2;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;">
            Contacto
        </th>
    </tr>
    @if(isset($emailVars["tabla"]["Viernes"]))
        <tr style=" background-color: #ffffff;">
            <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                Viernes
            </td>
            <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! $emailVars["tabla"]["Viernes"]["punto"] !!}</td>
            <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! isset($emailVars["tabla"]["Viernes"]["informacion"]) ? $emailVars["tabla"]["Viernes"]["informacion"] : '' !!}</td>
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
            <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! isset($emailVars["tabla"]["Sabado"]["informacion"]) ? $emailVars["tabla"]["Sabado"]["informacion"] : '' !!}</td>
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
            <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! isset($emailVars["tabla"]["Domingo"]["informacion"]) ? $emailVars["tabla"]["Domingo"]["informacion"] : '' !!}</td>
            <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">{!! $emailVars["tabla"]["Domingo"]["zona"] !!}</td>
            @if(isset($emailVars["tabla"]["Domingo"]["fb"]))
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                    <a href="{!! $emailVars["tabla"]["Domingo"]["fb"] !!}">FACEBOOK</a>
                </td>
            @endif
        </tr>
    @endif
</table>

@if(isset($emailVars['edad']) && $emailVars['edad'] >= 18 && $emailVars['edad'] <= 35)

    <h1 style="line-height: 20.7999992370605px;"><br/>
        Si sos mayor de 18 a&ntilde;os...</h1>

    <h1 class="null" style="line-height: 20.7999992370605px;"><br/>
        <span style="font-size:23px"><span style="font-family:arial,helvetica neue,helvetica,sans-serif"><a
                        href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado"
                        target="_blank"><img align="none" height="87"
                                             src="https://gallery.mailchimp.com/e1e6f3ad0ecbaf71f74cd71dc/images/064cea0f-f404-46e1-88cc-47001dc15535.png"
                                             style="width: 841px; height: 87px; margin: 0px;"
                                             width="841"/></a></span></span>
    </h1>
@endif
<h1 class="null" style="text-align: left;"><br/>
    Un abrazo,<br/>
    <br/>
    Equipo de Colecta&nbsp;<br/>
    <br/>
    &nbsp;</h1>

</body>
</html>