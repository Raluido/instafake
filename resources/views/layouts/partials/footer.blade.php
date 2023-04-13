<nav class="">
    <div class="">
        <a href="{{ route('home') }}" class="">
            <i class="fa-solid fa-house"></i>
        </a>
    </div>
    <div class="">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    <div class="">
        <a href="{{ $nick }}/images/upload" class=""><i class="fa-solid fa-square-plus"></i></a>
    </div>
    <div class="">
        <i class="fa-sharp fa-solid fa-circle-play"></i>
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