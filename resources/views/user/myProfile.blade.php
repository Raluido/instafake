@extends('layouts.profile')

@section('main')

<section class="myProfile">
    <div class="innerMyProfile">
        <div class="top">
            <div class="innerTop">
                <div class="avatar">
                    <img src="{{ Storage::url('/media/' . $user[0]->id . '/' . $user[0]->image) }}" alt="" class="">
                </div>
                <div class="publishedAndFollows">
                    <a href="" class="">{{ $published }} Publicaciones</a>
                    <a href="" class="">{{ $followers }} Seguidores</a>
                    <a href="" class="">{{ $followings }} Siguiendo</a>
                </div>
            </div>
            <h4></h4>
            <h3 class=""></h3>
            <h3 class=""></h3>
            <h3 class=""></h3>
        </div>
        <div class="bottom">
            <div class="innerBottom">
                @if(!is_string($images))
                @foreach($images as $index)
                <div class=""><img src="{{ Storage::url('/media/ . $user[0]->id . '/' . $user->id . '/library/images/' . $index->filename) }}" alt="" class=""></div>
                @endforeach
                @else
                <p class="">$images</p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection