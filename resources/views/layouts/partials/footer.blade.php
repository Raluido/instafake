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
        <a href="{{ route('logout.perform') }}" class="">
            <img src="{{ Storage::url('storage/media/. $id ./avatar.png') }}" alt="" class="">
        </a>
        @else :
        <img src="{{ Storage::url('storage/default/avatar.png') }}" alt="" class="">
        @endif
    </div>
</nav>