<div class="group">
    <label for="{!! $formName !!}" class="used-select {!! isset($id) == true ? 'used' : '' !!}"><i class="fa fa-arrow-right"></i>{!! $name !!}</label>
    <select class="select" name="{!! $formName !!}" id="{!! $formName !!}">
        {{-- */$select = '';/* --}}
        @if (!isset($id))
            {{-- */$select = 'selected';/* --}}
        @endif
        <option value="" {!! $select !!} disabled></option>
        {{-- */$select = '';/* --}}
        @foreach ($models as $model)
            @if (isset($id) && $id == $model->id)
                {{-- */$select = 'selected';/* --}}
            @endif
            <option {!! $select  !!} value=' {!! $model->id  !!}'>{!! $model->nombreMostrar ? $model->nombreMostrar : $model->nombre !!}</option>
            {{-- */$select = '';/* --}}
        @endforeach
    </select>
</div>