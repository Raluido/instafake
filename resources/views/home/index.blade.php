@extends('layouts.master')

@section('main')
<section class="home">
    <div class="innerHome">
        <div class="top">
            <div class="innerTop">
                @if(auth()->user()->image)
                <a href="{{ route('stories.uploadForm', $nick) }}" class="addStory">
                    <div class="addStoryImg">
                        <img src="{{ route('user.avatar', ['nick' => $nick, 'filename' => auth()->user()->image]) }}" alt="" class="">
                    </div>
                    <h5 class="">Tu historia</h5>
                    <div class="addStoryPlus">
                        <p class="">+</p>
                    </div>
                </a>
                @else
                <a href="{{ route('stories.uploadForm', $nick) }}" class="addStory">
                    <div class="addStoryImg">
                        <img src="{{ Storage::disk('images')->url('default/avatar.png') }}" alt="" class="">
                    </div>
                    <h5 class="">Tu historia</h5>
                    <div class="addStoryPlus">
                        <p class="">+</p>
                    </div>
                </a>
                @endif
                @foreach($stories as $story)
                @if(auth()->user()->image)
                <a class="story btn-play" data-story="{{ $story->id }}" data-user="{{ $story->user_id }}">
                    <div class="storyImg">
                        <img src="{{ route('stories.show', ['nick' => $nick, 'filename' => $story->image]) }}" alt="" class="">
                    </div>
                    <h5 class="">{{ $story->nick }}</h5>
                </a>
                @else
                <a class="story btn-play" data-story="{{ $story->id }}" data-user="{{ $story->user_id }}">
                    <div class="storyImg">
                        <img src="{{ route('stories.show', ['nick' => $nick, 'filename' => $story->image]) }}" alt="" class="">
                    </div>
                    <h5 class="">{{ $story->nick }}</h5>
                </a>
                @endif
                @endforeach
            </div>
        </div>
        <video class="d-none storyPlayer" width="100%" height="auto" id="storyPlay" controls>
            <source src="" id="mp4Source" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="bottom">
            <div class="innerBottom">
                @foreach($followings as $following)
                @foreach($following->userFollowing->images as $image)
                <div class="post">
                    <div class="image">
                        <div class="pic">
                            <img src="{{ Storage::url('media/' . $following->following . '/library/images/' . $image->filename) }}" alt="" class="">
                        </div>
                        <div class="bottom">
                            <div class="icons">
                                @if(count($image->likes) > 0)
                                @foreach($image->likes as $like)
                                @php $i = 0; @endphp
                                @if($following->follower != $like->giver)
                                @php $i++; @endphp
                                @endif
                                @endforeach
                                @if(count($image->likes) == $i)
                                <a href="" class=""><i data-id="{{ $image->id }}" class="fa-regular fa-heart btn-like"></i></a>
                                @else
                                <a href="" class=""><i data-id="{{ $image->id }}" class="fa-regular fa-heart btn-like like"></i></a>
                                @endif

                                @else
                                <a href="" class=""><i data-id="{{ $image->id }}" class="fa-regular fa-heart btn-like"></i></a>
                                @endif
                                <a href="{{ route('comments.showAll', [$nick, $image->id]) }}" class=""><i class="fa-solid fa-comment"></i></a>
                                <i class="fa-solid fa-paper-plane"></i>
                            </div>
                            <div class="likes" data-id="{{ $image->id }}">
                                <p class="countLikes" data-id="{{ $image->id }}">{{ count($image->likes) }} Me gusta</p>
                            </div>
                            <div class="imageName">
                                <p class="">
                                    <span class="" style="font-weight:bold;">{{ $image->user->nick }}</span> {{ $image->name}}
                                </p>
                            </div>
                            <div class="comments">
                                <div class="innerComments">
                                    @if(count($image->comments) > 0)
                                    <a href="{{ route('comments.showAll', [$nick, $image->id]) }}" class="">
                                        <p class="">Ver los {{ count($image->comments) }} comentarios</p>
                                    </a>
                                    <!-- @foreach($image->comments as $comment)
                                                <div class="likesComments">
                                                    <p class="">{{ $comment->content }}</p>

                                                    @if(count($comment->likesComments) > 0)

                                                        @foreach($comment->likesComments as $likeComment)
                                                            @php $i = 0; @endphp

                                                            @if($following->follower != $likeComment->giver)
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
                                                @endforeach -->

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
            </div>
            <input type="hidden" class="" id="inputNick" value="{{ $nick }}">
        </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/playStories.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/planeMessages.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/getLike.js') }}" defer></script>
@endsection