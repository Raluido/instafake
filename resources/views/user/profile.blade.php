@extends('layouts.profile')

@section('main')

<section class="myProfile">
    <div class="innerMyProfile">
        <div class="top">
            <div class="innerTop">
                <div class="followCount">
                    <div class="avatar">
                        <img src="{{ route('user.avatar', ['nick' => $nick, 'filename' => $user->image, 'id' => $user->id]) }}" alt="" class="">
                    </div>
                    <div class="publishedAndFollows">
                        <a href="" class="">{{ count($user->images) }} <br> Publicaciones</a>
                        <a href="" class="followers">{{ count($user->followings) }} <br> Seguidores</a>
                        <a href="" class="followings">{{ count($user->followers) }} <br> Siguiendo</a>
                    </div>
                </div>
                <h4>{{ $user->name . " " . $user->surname}}</h4>
                <h3 class=""></h3>
                <h3 class=""></h3>
                <h3 class=""></h3>
                @if(auth()->id() != $user->id)
                <div class="followBtns">
                    <input type="hidden" name="following" id="followingId" value="{{ $user->id }}" class="">
                    <input type="hidden" name="nick" id="nickName" value="{{ $nick }}" class="">
                    @if(!in_array(auth()->id(), $followers))
                    <button id="follow">Seguir</button>
                    @else
                    <button id="unfollow" class="">Dejar de seguir</button>
                    @endif
                    <button class="sendMsj"><a href="{{ route('messages.show', [$nick,$user->id]) }}" class="">Enviar mensaje</a></button>
                </div>
                @endif
            </div>
        </div>
        <div class="bottom">
            <div class="innerBottom">
                @foreach($user->images as $index)
                <div class="published"><a href="{{ route('user.publications',  ['nick' => $nick, 'imageId' => $index->id, 'userId' => $index->user->id]) }}" class=""><img src="{{ Storage::disk('images')->url($user->id . '/' . $index->filename) }}" alt="" class=""></a></div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/followUnfollow.js') }}" defer></script>
endsection