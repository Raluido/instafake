@extends('layouts.master')

@section('main')
<section class="">
    <div class="stories">
        <div class="innerStories">
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

    <div class="posts">
        @foreach($images as $image)
        <div class="">
            <div class="image">
                <div class="pic">
                    <img src="{{ Storage::url('storage/media/' . $id . '/images/' . $image) }}" alt="" class="">
                </div>
                <div class="icons">
                    <i class="fa-solid fa-heart"></i>
                    <i class="fa-solid fa-comment"></i>
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
            </div>
            <p class="comment">{{ $image->comments }}</p>
        </div>
        @endforeach
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/planeMessages.js') }}"></script>
@endsection