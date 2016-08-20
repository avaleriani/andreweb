<div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-globe"></i> {!! $name !!}</h3>
    @if(isset($new))
        <a href="{!! route($route) !!}" class="btn btn-new">{!! $new !!}</a>
    @endif
</div>