@extends('layouts.master')

@section('main')
<section class="home">
    <div class="innerHome">
        <div class="top">
            <div class="innerTop">
                @if(file_exists('storage/media/' . $id . '/avatar.jpg'))
                <a href="{{ route('story.uploadForm', $nick) }}" class="addStory">
                    <div class="addStoryImg">
                        <img src="{{ Storage::url('media/' . $id . '/avatar.jpg') }}" alt="" class="">
                    </div>
                    <h5 class="">Tu historia</h5>
                    <div class="addStoryPlus">
                        <p class="">+</p>
                    </div>
                </a>
                @else
                <a href="{{ route('story.uploadForm', $nick) }}" class="addStory">
                    <div class="addStoryImg">
                        <img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    </div>
                    <h5 class="">Tu historia</h5>
                </a>
                @endif
                @if(is_string($stories))
                @else
                @foreach($stories as $story)
                @if(file_exists('storage/' . $story->user_id . '/avatar.jpg'))
                <a class="story btn-play" data-story="{{ $story->id }}" data-user="{{ $story->user_id }}">
                    <div class="storyImg">
                        <img src="{{ Storage::url('media/' . $story->user_id . '/avatar.jpg') }}" alt="" class="">
                    </div>
                    <h5 class="">{{ $story->nick }}</h5>
                </a>
                @else
                <a class="story btn-play" data-story="{{ $story->id }}" data-user="{{ $story->user_id }}">
                    <div class="storyImg">
                        <img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    </div>
                    <h5 class="">{{ $story->nick }}</h5>
                </a>
                @endif
                @endforeach
                @endif
            </div>
        </div>
        <video class="d-none storyPlayer" width="100%" height="auto" id="storyPlay" controls>
            <source src="" id="mp4Source" type="video/mp4">
            Your browser does not support the video tag.
        </video>
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
                                $id = auth()->id();
                                @endphp

                                @if (!is_string($likesArr))

                                @if(in_array($image->id, $likesArr))
                                <a href="" class=""><i data-id="{{ $image->id }}" class="fa-regular fa-heart btn-like like"></i></a>
                                @else
                                <a href="" class=""><i data-id="{{ $image->id }}" class="fa-regular fa-heart btn-like"></i></a>
                                @endif

                                @else
                                <a href="" class=""><i data-id="{{ $image->id }}" class="fa-regular fa-heart btn-like"></i></a>
                                @endif

                                @php
                                $like = App\Models\Like::where('image_id', '=', $image->id)->count();
                                @endphp
                                <i class="fa-solid fa-comment"></i>
                                <i class="fa-solid fa-paper-plane"></i>
                            </div>
                            <div class="likes">
                                <p class="countLikes">{{ $like }} likes</p>
                            </div>
                            <div class="imageName">
                                <p class="">
                                    <span class="" style="font-weight:bold;">{{ $image->nick }}</span> {{ $image->name}}
                                </p>
                            </div>
                            <div class="comments">
                                @if(is_string($comments))
                                <div class="">
                                    <p class="">No hay comentarios aun!</p>
                                </div>
                                @else
                                @foreach($comments as $comment)
                                @if($image->id == $comment->image_id)
                                <div class="likesComments">
                                    <p class="">{{ $comment->content }}</p>
                                    @php
                                    $likeComment = "";
                                    $likeComment = App\Models\LikeComment::where('comment_id', '=', $comment->id)->count();
                                    @endphp
                                    @if(!is_string($likesCommentsArr))
                                    @if(in_array($comment->id, $likesCommentsArr))
                                    <div class="innerLikesComments">
                                        <a href="" class=""><i data-id="{{ $comment->id }}" class="fa-regular fa-heart btn-likeComment likeComment"></i></a>
                                        <p class="countLikesComments">{{ $likeComment }} likes</p>
                                    </div>
                                    @else
                                    <div class="innerLikesComments">
                                        <a href="" class=""><i data-id="{{ $comment->id }}" class="fa-regular fa-heart btn-likeComment"></i></a>
                                        <p class="countLikesComments">{{ $likeComment }} likes</p>
                                    </div>
                                    @endif
                                    @endif
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
<script type="text/javascript" src="{{ asset('js/playStories.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/planeMessages.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/getLike.js') }}" defer></script>
@endsection