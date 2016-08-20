<section id="anotate">
    <div class="datos-voluntario">
        <div class="logo-colecta"></div>
        <div class="dias-colecta">
            {!! $dias . ' de ' . $nombreMes !!}
        </div>
        @include('pages.front.components.anotate-form')
        <div class="compartir">
            <span class="fb">
                <a href="https://www.facebook.com/sharer/sharer.php?u=colecta.techo.org.ar/" target="_blank"
                   onclick="window.open(this.href, 'Colecta - TECHO','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                    <img src="{!! asset('img/front/fb.png') !!}"/>
                </a>
            </span>
            <span class="tw">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://colecta.techo.org.ar/" target="_blank" data-text="Sumate a la #ColectaTECHO!"
                   onclick="window.open(this.href, 'Colecta - TECHO','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                    <img src="{!! asset('img/front/tw.png') !!}"/>
                </a>
            </div>
        </div>
    </div>
    <div class="datos-colecta">
        <div class="imagen-portada">
            <img class="img-portada" src="{!! asset('img/front/_anotate.jpg') !!}"/>
        </div>
        <div class="datos">
            <span class="anotados">YA SOMOS  <span class="anotados-numero">{!! $anotados !!}</span> ANOTADOS</span>
            <span class="faltan"> FALTAN  <span class="faltan-numero">{!! $df!!}</span> D&Iacute;AS </span>
        </div>
    </div>
</section>