<div class="alert-container">
    @if(Session::get('message') != null)
        {{-- */ $session = Session::get('message') /* --}}
        @if(is_array($session))
            {{-- */ $session = implode('<br>',$session) /* --}}
        @endif
        <p class="alert alert-success"><em> {!! $session !!}</em></p>
    @endif
</div>