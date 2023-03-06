<nav class="">
    <div class="">
        <h5 class="">
            home
        </h5>
    </div>
    <div class="">
        <h5 class="">Añadir</h5>
    </div>
    <div class="">
        <h5 class="">
            Reels
        </h5>
    </div>
    <div class="profileImg">
        @if(Auth::check()) :
        <a href="{{ route('logout') }}" class="">
            <img src="{{ asset('storage/media/default/avatar.png') }}" alt="" class="">
        </a>
        @endif
    </div>
</nav>