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
                @if(is_string($images))
                <p class="">{{ $images }}</p>
                @else
                @foreach($images as $image)
                <div class="post">
                    <div class="image">
                        <div class="pic">
                            <img src="{{ Storage::url('media/' . $id . '/library/images/' . $image->filename) }}" alt="" class="">
                        </div>
                        <div class="icons">
                            <?php
                            $i = 0;
                            foreach ($likes as $like) {
                                if ($image->id == $like->image_id) {
                                    $i++;
                                };
                            }
                            ?>
                            <i class="fa-solid fa-heart">{{ $i }}</i>
                            <i class="fa-solid fa-comment"></i>
                            <i class="fa-solid fa-paper-plane"></i>
                        </div>
                        <div class="">
                            <p class="">
                                {{ $image->nick }} {{ $image->name}}
                            </p>
                        </div>
                        @foreach($comments as $comment)
                        @if($image->id == $comment->image_id)
                        <div class="">
                            <p class="comment">{{ $comment->content }}</p>
                        </div>
                        @else
                        <div class="">
                            <p class="">No hay comentarios aun!</p>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <input type="hidden" class="" id="inputNick" value="{{ $nick }}">
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/planeMessages.js') }}" defer></script>
@endsection