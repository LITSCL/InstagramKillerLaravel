@if (Auth::user()->imagen)
    <img class="avatar" src="{{ url('usuario/avatar/' . Auth::user()->imagen) }}"/>
@endif
