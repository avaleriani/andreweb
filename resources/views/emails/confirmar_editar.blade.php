<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title>Tus nuevos puntos!</title>
</head>
<body style="font-family:Arial, sans-serif; font-size: 12px;">
<h1><strong>&iexcl;Hola&nbsp;</strong>{!! $emailVars["nombre"] !!}<strong>!</strong><br/>
   <p>Estos son los puntos en los que estas anotado para la colecta: </p>
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
        <!--<th style="font-size: 12px;background-color: #acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align: left;"
            >Encargado de zona
        </th>
        -->
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
            <!-- <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                <table>
                    <?php
            /*if (isset($emailVars["tabla"]["Viernes"]["encargados"])) {
                foreach ($emailVars["tabla"]["Viernes"]["encargados"] as $enc) {
                    ?>
                    <tr>
                        <td>{!! $enc["nombreEncargado"] !!}</td>
                        <td>{!! $enc["mailEncargado"] !!}</td>
                    </tr>
                <?php
                }
            } */
            ?>
                </table>
            </td>
            -->
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
            <!-- <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                <table>
                    <?php
            /*if (isset($emailVars["tabla"]["Sabado"]["encargados"])) {
                foreach ($emailVars["tabla"]["Sabado"]["encargados"] as $enc) {
                    ?>
                    <tr>
                        <td>{!! $enc["nombreEncargado"] !!}</td>
                        <td>{!! $enc["mailEncargado"] !!}</td>
                    </tr>
                <?php
                }
            }*/
            ?>
                </table>
            </td>
            -->
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
            <!--  <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                <table>
                    <?php
            /* if (isset($emailVars["tabla"]["Domingo"]["encargados"])) {
                 foreach ($emailVars["tabla"]["Domingo"]["encargados"] as $enc) {
                     ?>
                     <tr>
                         <td>{!! $enc["nombreEncargado"] !!}</td>
                         <td>{!! $enc["mailEncargado"] !!}</td>
                     </tr>
                 <?php
                 }
             }*/
            ?>
                </table>
            </td>
            -->
           @if(isset($emailVars["tabla"]["Domingo"]["fb"]))
                <td style="font-size: 12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;">
                    <a href="{!! $emailVars["tabla"]["Domingo"]["fb"] !!}">FACEBOOK</a>
                </td>
            @endif
        </tr>
    @endif
</table>

@if (isset($emailVars['edad']) && $emailVars['edad'] >= 18 && $emailVars['edad'] <= 35)

    <h1 style="line-height: 20.7999992370605px;"><br/>
        Si sos mayor de 18 a&ntilde;os...</h1>

    <h1 class="null" style="line-height: 20.7999992370605px;"><br/>
    <span style="font-size:23px"><span style="font-family:arial,helvetica neue,helvetica,sans-serif"><a
                href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado"
                target="_blank"><img align="none" height="87"
                                     src="https://gallery.mailchimp.com/e1e6f3ad0ecbaf71f74cd71dc/images/064cea0f-f404-46e1-88cc-47001dc15535.png"
                                     style="width: 841px; height: 87px; margin: 0px;" width="841"/></a></span></span>
    </h1>

    <h1 class="null" style="text-align: center;"><span style="font-size:25px"><strong><a
                    href="http://techo.org/argentina/Intra_PRD/nuevos_voluntarios/"
                    target="_blank">Buenos&nbsp;Aires</a>&nbsp;
            </strong></span><a
            href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado/la-plata"
            style="font-size: 25px; line-height: 1.6em;" target="_blank">La Plata</a>&nbsp;<a
            href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado/crdoba"
            style="font-size: 25px; line-height: 1.6em;" target="_blank">C&oacute;rdoba&nbsp;</a>&nbsp;<a
            href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado/ro-cuarto"
            style="font-size: 25px; line-height: 1.6em;" target="_blank">R&iacute;o Cuarto</a>&nbsp;<a
            href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado/misiones"
            style="font-size: 25px; line-height: 1.6em;" target="_blank">Misiones</a>&nbsp;<a
            href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado/salta"
            style="font-size: 13px; line-height: 1.6em;" target="_blank"><span
                style="font-size:25px; line-height:1.6em">S</span><span style="font-size:24px; line-height:1.6em"><span
                    style="font-family:arial,helvetica neue,helvetica,sans-serif">alta</span></span></a>&nbsp;<a
            href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado/neuqun--ro-negro"
            style="font-family: arial, 'helvetica neue', helvetica, sans-serif; font-size: 24px; line-height: 1.6em;"
            target="_blank">Neuqu&eacute;n/R&iacute;o Negro</a>&nbsp;<a
            href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado/corrientes--chaco"
            style="font-family: arial, 'helvetica neue', helvetica, sans-serif; font-size: 24px; line-height: 1.6em;"
            target="_blank">Corrientes/Chaco</a>&nbsp;<a
            href="https://sites.google.com/a/techo.org/intranet-argentina/areas/formacion-y-voluntariado/rosario"
            style="font-family: arial, 'helvetica neue', helvetica, sans-serif; font-size: 24px; line-height: 1.6em;"
            target="_blank">Rosario</a></h1>

@endif
<h1 class="null" style="text-align: left;"><br/>
    <em>Un abrazo,</em><br/>
    <br/>
    Equipo de Colecta&nbsp;<br/>
    <br/>
    <?php
    $nombres = array();
    /*
    if (isset($emailVars["tabla"]["Viernes"]["encargados"])) {
        foreach ($emailVars["tabla"]["Viernes"]["encargados"] as $enc) {
            if (!in_array($enc["nombreEncargado"], $nombres)) {
                $nombres[] = $enc["nombreEncargado"];
            }
        }
    }
    if (isset($emailVars["tabla"]["Sabado"]["encargados"])) {
        foreach ($emailVars["tabla"]["Sabado"]["encargados"] as $enc) {
            if (!in_array($enc["nombreEncargado"], $nombres)) {
                $nombres[] = $enc["nombreEncargado"];
            }
        }
    }
    if (isset($emailVars["tabla"]["Domingo"]["encargados"])) {
        foreach ($emailVars["tabla"]["Domingo"]["encargados"] as $enc) {
            if (!in_array($enc["nombreEncargado"], $nombres)) {
                $nombres[] = $enc["nombreEncargado"];
            }
        }
    }
    echo implode(', ', $nombres);
    */
    ?>
    &nbsp;</h1>

</body>
</html>
