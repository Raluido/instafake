@extends('layouts.profile')

@section('main')

<section class="myProfile">
    <div class="innerMyProfile">
        <div class="top">
            <div class="innerTop">
                <div class="followCount">
                    <div class="avatar">
                        <img src="{{ route('user.avatar', ['nick' => $nick, 'filename' => $user->image, 'id' => $userId]) }}" alt="" class="">
                    </div>
                    <div class="publishedAndFollows">
                        <a href="" class="">{{ count($user->images) }} <br> Publicaciones</a>
                        <a href="" class="">{{ count($user->followers) }} <br> Seguidores</a>
                        <a href="" class="">{{ count($user->followings) }} <br> Siguiendo</a>
                    </div>
                </div>
                <h4>{{ $user->name . " " . $user->surname}}</h4>
                <h3 class=""></h3>
                <h3 class=""></h3>
                <h3 class=""></h3>
                @if(auth()->id() != $user->id)
                <div class="followBtns">
                    <form action="{{ route('user.follow', $nick) }}" method="post" class="follow">
                        @csrf
                        <input type="hidden" name="following" id="followingId" value="{{ $user->id }}" class="">
                        <input type="hidden" name="nick" id="nickName" value="{{ $nick }}" class="">
                        <input type="submit" value="Seguir" class="inputSubmit">
                    </form>
                    <form action="{{ route('user.unfollow', [$nick, $user->id]) }}" method="post" class="unFollow">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="following" id="followingId" value="{{ $user->id }}" class="">
                        <input type="submit" value="Dejar de seguir" class="inputSubmit">
                    </form>
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
<script class="" type="text/javascript" src="{{ asset('js/checkFollows.js') }}" defer></script>
endsection