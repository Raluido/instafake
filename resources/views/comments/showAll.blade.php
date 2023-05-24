@extends('layouts.comments')


@section('main')
<section class="home">
    <div class="innerHome">
        <div class="top">
            <div class="innerTop">

            </div>
        </div>

        <div class="bottom">
            <div class="innerBottom">
                <div class="comments">
                    <div class="likesComments">
                        @if($images)
                            @foreach($images as $image)
                                @foreach($image->comments as $comment)
                                    <p class="">{{ $comment->content }}</p>

                                    @if(count($comment->likesComments) > 0)

                                        @foreach($comment->likesComments as $likeComment)
                                            @php $i = 0; @endphp

                                            @if($id != $likeComment->giver)
                                                @php $i++; @endphp
                                            @endif

                                        @endforeach

                                                @if(count($comment->likesComments) == $i)
                                                <div class="innerLikesComments" data-id="{{ $comment->id }}">
                                                    <a href="" class=""><i data-id="{{ $comment->id }}" class="fa-regular fa-heart btn-likeComment"></i></a>
                                                    <p class="countLikesComments" data-id="{{ $comment->id }}">{{ count($comment->likesComments) }}</p>
                                                </div>
                                                @else
                                                <div class="innerLikesComments" data-id="{{ $comment->id }}">
                                                    <a href="" class=""><i data-id="{{ $comment->id }}" class="fa-regular fa-heart btn-likeComment likeComment"></i></a>
                                                    <p class="countLikesComments" data-id="{{ $comment->id }}">{{ count($comment->likesComments) }}</p>
                                                </div>
                                                @endif
                                            

                                    @else
                                        <div class="innerLikesComments" data-id="{{ $comment->id }}">
                                            <a href="" class=""><i data-id="{{ $comment->id }}" class="fa-regular fa-heart btn-likeComment"></i></a>
                                            <p class="countLikesComments" data-id="{{ $comment->id }}">{{ count($comment->likesComments) }}</p>
                                        </div>
                                    @endif

                                @endforeach

                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <input type="hidden" class="" id="inputNick" value="{{ $nick }}">
        </div>
</section>
@endsection
@section('js')

@endsection