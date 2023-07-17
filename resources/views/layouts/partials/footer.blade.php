<nav class="">
    <div class="">
        <a href="{{ route('home') }}" class="">
            <i class="fa-solid fa-house"></i>
        </a>
    </div>
    <div class="">
        <a href="{{ route('user.searchForm', $nick) }}" class=""><i class="fa-solid fa-magnifying-glass"></i></a>
    </div>
    <div class="">
        <a href="{{ $nick }}/images/upload" class=""><i class="fa-solid fa-square-plus"></i></a>
    </div>
    <div class="">
        <i class="fa-sharp fa-solid fa-circle-play"></i>
    </div>
    <div class="profileImg">
        @if(auth()->user()->image)
        <a href="{{ route('user.myProfile', $nick) }}" class="">
            <div class="">
                <img src="{{ route('images.show', ['filename' => auth()->user()->image, 'nick' => $nick]) }}" alt="" class="">
            </div>
        </a>
        @else
        <a href="{{ route('user.myProfile', $nick) }}" class="">
            <div class="">
                <img src="{{ Storage::disk('profiles')->url('default/avatar.png') }}" alt="" class="">
            </div>
        </a>
        @endif
    </div>
</nav>