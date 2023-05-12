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
                            <img src="{{ Storage::url('media/' . $image->following . '/library/images/' . $image->filename) }}" alt="" class="">
                        </div>
                        <div class="bottom">
                            <div class="icons">
                                @php
                                $i = 0;
                                $id = auth()->id();
                                @endphp

                                @if (!is_string($likes))
                                @if (in_array($id, $likedAr))
                                <a href="" class=""><i data-id="{{ $image->id }}" class="fa-regular fa-heart btn-like like"></i></a>
                                @else
                                <a href="" class=""><i data-id="{{ $image->id }}" class="fa-regular fa-heart btn-like"></i></a>
                                @endif
                                @foreach ($likedAr as $index)
                                @if ($image->id == $index)
                                @php $i++; @endphp
                                @endif
                                @endforeach
                                @endif

                                <i class="fa-solid fa-comment"></i>
                                <i class="fa-solid fa-paper-plane"></i>
                            </div>
                            <div class="likes">
                                <p class="">{{ $i }} likes</p>
                            </div>
                            <div class="imageName">
                                <p class="">
                                    <span class="" style="font-weight:bold;">{{ $image->nick }}</span> {{ $image->name}}
                                </p>
                            </div>
                            <div class="comments">
                                @if(is_string($comments[0]))
                                <div class="">
                                    <p class="">No hay comentarios aun!</p>
                                </div>
                                @else
                                @foreach($comments as $comment)
                                @if($image->id == $comment->image_id)
                                <div class="">
                                    <p class="">{{ $comment->content }}</p>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
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
<script type="text/javascript" src="{{ asset('js/getLike.js') }}" defer></script>
@endsection