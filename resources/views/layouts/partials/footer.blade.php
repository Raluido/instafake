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
        @if(File::exists(Storage::url('media/' . $id . '/avatar.png')))
        <div class="">
            <a href="{{ route('logout.perform') }}" class="">
                <img src="{{ Storage::url('media/' . $id . '/avatar.png') }}" alt="" class="">
            </a>
        </div>
        @else
        <div class="">
            <a href="{{ route('logout.perform') }}" class="">
                <img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
            </a>
        </div>
        @endif
    </div>
</nav>