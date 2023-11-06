@extends('layouts.comments')


@section('main')
<section class="allComments">
    <div class="innerAllComments">
        <div class="top">
            <div class="innerTop">

            </div>
        </div>

        <div class="bottom">
            <div class="innerBottom">
                @if($images)
                @php $i = 0; @endphp
                @foreach($images as $image)
                <div class="comments">
                    <div class="innerComments">
                        @foreach($image->comments as $comment)
                        @php $i++; @endphp
                        <div class="avatar">
                            <div class="innerAvatar">
                                @if(auth()->user()->image)
                                <a href="{{ route('user.myProfile', $nick) }}" class="">
                                    <div class="">
                                        <img src="{{ Storage::disk('profiles')->url($comment->user->id . '/' . $comment->user->image) }}" alt="" class="">
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
                            <div class="content">
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

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                @endif
                <div class="addNewComment">
                    <form action="{{ route('comments.store', $nick) }}" method="POST" class="" id="submitForm">
                        @csrf
                        <textarea placeholder="Añade un comentario..." name="content" id="textarea" wrap="hard" data-min-rows='2' class="replyInput textarea autoExpand"></textarea>
                        <input type="hidden" name="imageId" value="{{ $image->id }}" class="">
                    </form>
                </div>
                @if(count($errors) > 0)
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
                @endif
            </div>
            <input type="hidden" class="" id="inputNick" value="{{ $nick }}">
        </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/autoExpand.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/scrollDown.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/getLike.js') }}" defer></script>
@endsection