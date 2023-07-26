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
                        <img src="{{ Storage::disk('profiles')->url('default/avatar.png') }}" alt="" class="">
                    </div>
                    <h5 class="">Tu historia</h5>
                    <div class="addStoryPlus">
                        <p class="">+</p>
                    </div>
                </a>
                @endif
                @foreach($stories as $story)
                @if($story->image)
                <a class="story btn-play" data-story="{{ $story->id }}" data-user="{{ $story->user_id }}">
                    <div class="storyImg">
                        <img src="{{ route('user.avatar', ['nick' => $nick, 'filename' => $story->image, 'id' => $story->user_id]) }}" alt="" class="">
                    </div>
                    <h5 class="">{{ $story->nick }}</h5>
                </a>
                @else
                <a class="story btn-play" data-story="{{ $story->id }}" data-user="{{ $story->user_id }}">
                    <div class="storyImg">
                        <img src="{{ Storage::disk('profiles')->url('default/avatar.png') }}" alt="" class="">
                    </div>
                    <h5 class="">{{ $story->nick }}</h5>
                </a>
                @endif
                @endforeach
            </div>
        </div>
        <video class="d-none storyPlayer" width="100%" height="auto" id="storyPlay">
            <source src="" id="mp4Source" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="bottom">
            <div class="innerBottom">
                @foreach($followings as $following)
                @foreach($following->userFollowing->images as $image)
                <div class="post">
                    <div class="image">
                        <div class="top">
                            <div class="icon">
                                @if($image->user->image != null && file_exists('profiles/' . $image->user->id . '/' . $image->user->image))
                                <img src="{{ Storage::disk('profiles')->url($image->user->id . '/' . $image->user->image) }}" alt="" class="">
                                @else
                                <img src="{{ Storage::disk('profiles')->url('default/avatar.png') }}" alt="" class="">
                                @endif
                            </div>
                            <div class="info">
                                <div class="name">
                                    <h5 class="">
                                        {{ $image->user->nick }}
                                    </h5>
                                </div>
                                <div class="place">
                                    <p class="">
                                        {{ $image->location }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="pic">
                            <img src="{{ Storage::disk('images')->url($following->following . '/' . $image->filename) }}" alt="" class="">
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
                                <a href="{{ route('messages.searchForm', ['nick' => $nick, 'imageId' => $image->id]) }}" class=""><i class="fa-solid fa-paper-plane"></i></a>
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