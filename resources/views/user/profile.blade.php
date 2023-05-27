@extends('layouts.profile')

@section('main')

<section class="myProfile">
    <div class="innerMyProfile">
        <div class="top">
            <div class="innerTop">
                <div class="followCount">
                    <div class="avatar">
                        <img src="{{ Storage::url('media/' . $user->id . '/' . $user->image) }}" alt="" class="">
                    </div>
                    <div class="publishedAndFollows">
                        <a href="" class="">{{ count($user->images) }} <br> Publicaciones</a>
                        <a href="" class="">{{ count($user->followers) }} <br> Seguidores</a>
                        <a href="" class="">{{ count($user->followings) }} <br> Siguiendo</a>
                    </div>
                    <h4>{{ $user->name . " " . $user->surname}}</h4>
                    <h3 class=""></h3>
                    <h3 class=""></h3>
                    <h3 class=""></h3>
                </div>
                <div class="followBtns">
                    <form action="{{ route('user.follow', $nick) }}" method="post" class="">
                        @csrf
                        <input type="hidden" name="following" id="followingId" value="{{ $user->id }}" class="">
                        <input type="hidden" name="nick" id="nickName" value="{{ $nick }}" class="">
                        <input type="submit" value="Seguir" class="inputSubmit">
                    </form>
                    <button class="sendMsj"><a href="{{ route('messages.show', [$nick,$user->id]) }}" class="sendMsj">Enviar mensaje</a></button>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="innerBottom">
                @foreach($user->images as $index)
                <div class="published"><img src="{{ Storage::url('media/' . $user->id . '/library/images/' . $index->filename) }}" alt="" class=""></div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script class="" type="text/javascript" src="{{ asset('js/checkFollows.js') }}"></script>
endsection