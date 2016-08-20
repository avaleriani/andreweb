<div id="modalEditarVoluntario" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onclick="$('#mModal').modal('hide');"><span
                        aria-hidden="true">&times;</span></button>
            <div id="modal-cont" class="modal-body">
                <div class="modal-titulo">
                    <p>Edita tus puntos</p>
                </div>
                <form id="form-voluntario-editar" class="frm-vol" action="/">
                    <div class="info">
                        Ingres&aacute; el correo electronico que usaste para anotarte y tu dni, recibir&aacute;s un
                        email con la URL para que puedas cambiar tus datos.
                    </div>
                    <div class="inputsnbtn">
                        <div>
                            <input type="text" id="editarVoluntarioText" name="editarVoluntarioText"
                                   class="editar-voluntario"
                                   placeholder="Correo"/>
                        </div>
                        <div>
                            <input type="text" id="editarVoluntarioDni" name="editarVoluntarioDni"
                                   class="editar-voluntario-dni"
                                   placeholder="DNI"/>
                        </div>
                    </div>
                    <div class="btn-save-voluntario">
                        <input type="submit" class="btn-save" id="sendVoluntario" name="sendVoluntario"
                               value="ENVIAR"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="mModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-border">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onclick="$('#mModal').modal('hide');"><span
                        aria-hidden="true">&times;</span></button>
            <div id="modal-cont2" class="modal-body">
                <div class="modal-titulo">
                    <p>GRACIAS POR ANOTARTE A LA</p>
                </div>
                <div class="modal-subtitulo">
                    <a href="#"><img src="{!! asset('img/front/_logo-horizontal.png') !!}"/></a>
                </div>
                <div class="modal-sub">
                    <p>&iexcl;CONT&Aacute;SELO A TUS AMIGOS EN FACEBOOK! </p>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=colecta.techo.org.ar/" target="_blank"
                       onclick="window.open(this.href, 'Colecta - TECHO','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                        <p class="fb-share-button"><img src="{!! asset('img/front/_fb-big.png') !!}"/></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>