<form method="get" action="{!! route($action) !!}" id="form_{!! $name !!}">
    <div class="controles-filtros">
        <div class="filtro-uno filtro-ciudads">
            @include('components.select', ['name' => $name, 'formName' => $formName, 'models' => $models, 'id' => $id])
        </div>
    </div>
    <div class="botones-filtro">
        <div class="btn-buscar"><input id="btn-filtrar" class="btn" type="submit" value="Filtrar"/></div>
        <div class="btn-buscar"><a class="btn" href="{!! route($action) !!}">Limpiar</a>
        </div>
    </div>
</form>