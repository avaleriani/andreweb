<div class="row">
    <div class="form-group">
        <label>Id</label>
        <p>{!! $ciudad->id !!}</p>
    </div>

    <div class="form-group">
        <label>Nombre</label>
        <p>{!! $ciudad->nombre !!}</p>
    </div>
    <div class="form-group">
        <label>Descripcion</label>
        <p>{!! $ciudad->descripcion !!}</p>
    </div>

    <div class="form-group">
        <label>Sede</label>
        <p>{!! $ciudad->sede->nombre !!}</p>
    </div>

</div>
