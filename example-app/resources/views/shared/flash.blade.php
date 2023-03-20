@if ($message = session('message'))
<div class="alert alert-success">
     {{ $message }}
</div>
@endif
@if ($dmessage = session('dMessage'))
<div class="alert alert-success">
     {{ $dmessage }}
     @if ($undoRoute = session('undoRoute'))
     <form action="{{$undoRoute}}" method="post" class="d-inline">
        @csrf
        @method('delete')
        <button type="submit" class="btn alert-link">Undo</button>
    </form>

    @endif

    </div>
@endif
