<form id="form-voluntario" method="POST">
    <div class="logoAnotate">
        <span class="lAnotate">ANOTATE</span>
    </div>
    <div class="step1">
        <div class="input-fila">
            <div class="tipito tip1"><img src="{!! asset('img/front/_person_left.png') !!}"></div>
            <input type="text" id="nombre" name="nombre" class="input-box" placeholder="NOMBRE" required>
        </div>
        <div class="input-fila">
            <input type="text" id="apellido" name="apellido" class="input-box" placeholder="APELLIDO" required>
        </div>
        <div class="input-fila">
            <input type="text" id="fnac" name="fnac" class="input-box" placeholder="FECHA DE NACIMIENTO(DIA/MES/AÑO)">
        </div>
        <div class="input-fila">
            <input type="text" id="dni" name="dni" class="input-box" placeholder="DNI" required>
        </div>
        <div class="input-fila">
            <input type="text" id="mail" name="mail" class="input-box" placeholder="MAIL" required>
            <div class="tipito tip2"><img src="{!! asset('img/front/_person_right.png') !!}"></div>
        </div>
        <div class="input-fila">
            <input type="text" id="telefono" name="telefono" class="input-box" placeholder="TEL&Eacute;FONO">
        </div>

        <div class="btn-siguiente">
            <input type="button" class="btn-form" id="siguiente" name="siguiente" value="SIGUIENTE >"/>
        </div>

        <a id="btn-editar">EDITA TUS PUNTOS</a>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="step2">
        <div class="input-fila ciudad-select required">
            <select class="sede-select" id="sede" name="sede">
                <option value="null">SEDE</option>
                @foreach ($sedes as $sede)
                    <option value='{!! $sede->id  !!}'>{!!  $sede->nombre !!} </option>
                @endforeach
            </select>
        </div>

        <div id="expand-selects">
            <div class="fila-dia dia-viernes"><label>Viernes</label></div>
            <div class="input-fila select">
                <select class="ciudad-select" id="ciudad1" name="ciudad1">
                    <option value="null">CIUDAD</option>
                </select>
            </div>
            <div class="input-fila select">
                <select class="zona-select" id="zona1" name="zona1">
                    <option value="null">ZONA</option>
                </select>
            </div>
            <div class="input-fila select">
                <select id="punto1" name="punto1">
                    <option value="null">PUNTO</option>
                </select>
            </div>

            <div class="fila-dia"><label>S&aacute;bado</label></div>
            <div class="input-fila select">
                <select class="ciudad-select" id="ciudad2" name="ciudad2">
                    <option value="null">CIUDAD</option>
                </select>
            </div>
            <div class="input-fila select">
                <select class="zona-select" id="zona2" name="zona2">
                    <option value="null">ZONA</option>
                </select>
            </div>
            <div class="input-fila select">
                <select id="punto2" name="punto2">
                    <option value="null">PUNTO</option>
                </select>
            </div>

            <div class="fila-dia"><label>Domingo</label></div>
            <div class="input-fila select">
                <select class="ciudad-select" id="ciudad3" name="ciudad3">
                    <option value="null">CIUDAD</option>
                </select>
            </div>
            <div class="input-fila select">
                <select class="zona-select" id="zona3" name="zona3">
                    <option value="null">ZONA</option>
                </select>
            </div>
            <div class="input-fila select">
                <select id="punto3" name="punto3">
                    <option value="null">PUNTO</option>
                </select>
            </div>
        </div>
        <div class="group-chbox terms">
            <input type="checkbox" class="ToS" name="tos" id="tos">
            <label for="tos">Aceptar <a target="_blank" href="{!! route('tos') !!}">terminos y condiciones</a></label>
        </div>
        <div class="btn-save-voluntario">
            <input type="button" class="btn-form" id="anterior" name="anterior" value="ANTERIOR"/>
        </div>
        <div class="btn-save-voluntario">
            <input type="submit" class="btn-form" id="sendForm" name="saveForm" value="ANOTARME"/>
        </div>
    </div>
</form>