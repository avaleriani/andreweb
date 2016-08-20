<div class="buscar-box">
    {{ Form::open(array('method' =>'GET')) }}
    <div class="search-bar">
        {!! Form::text('busqueda', $busqueda, array('class' => 'light-table-filter')) !!}
        {!! Form::submit('Buscar', array('class' => 'btn btn-search')) !!}
        @if(isset($clean) && $clean == true)
            <div><a class="btn" href="{!! route(Route::current()->getName()) !!}">Limpiar</a></div>
        @endif
    </div>

    {{ Form::close() }}
</div>