@extends('layouts.master')

@section('main')
<section class="home">
    <div class="innerHome">
        <div class="top">
            <div class="innerTop">
                <div class="story"><img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    <h5 class="">Juana</h5>
                </div>
                <div class="story"><img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    <h5 class="">Juana</h5>
                </div>
                <div class="story"><img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    <h5 class="">Juana</h5>
                </div>
                <div class="story"><img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    <h5 class="">Juana</h5>
                </div>
                <div class="story"><img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    <h5 class="">Juana</h5>
                </div>
                <div class="story"><img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    <h5 class="">Juana</h5>
                </div>
                <div class="story"><img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    <h5 class="">Juana</h5>
                </div>
                <div class="story"><img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    <h5 class="">Juana</h5>
                </div>
                <div class="story"><img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    <h5 class="">Juana</h5>
                </div>
            </div>
        </div>

        <div class="bottom">
            <div class="innerBottom">
                @foreach($images as $image)
                <div class="post">
                    <div class="image">
                        <div class="pic">
                            <img src="{{ Storage::url('media/' . $id . '/library/images/' . $image->filename) }}" alt="" class="">
                        </div>
                        <div class="icons">
                            <i class="fa-solid fa-heart"></i>
                            <i class="fa-solid fa-comment"></i>
                            <i class="fa-solid fa-paper-plane"></i>
                        </div>
                        <div class="">
                            <p class="">
                                {{ $image->user_id }} {{ $image->name}}
                            </p>
                        </div>
                        <div class="">
                            <p class="comment">{{ $image->comments }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <input type="hidden" class="" id="inputNick" value="{{ $nick }}">
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/planeMessages.js') }}" defer></script>
@endsection