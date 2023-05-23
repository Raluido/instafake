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
                @foreach($followings as $index)
                @foreach($index->userFollowing->stories as $index1)
                @if(file_exists('storage/' . $index1->user_id . '/avatar.jpg'))
                <a class="story btn-play" data-story="{{ $index1->id }}" data-user="{{ $index1->user_id }}">
                    <div class="storyImg">
                        <img src="{{ Storage::url('media/' . $index1->user_id . '/avatar.jpg') }}" alt="" class="">
                    </div>
                    <h5 class="">{{ $story->nick }}</h5>
                </a>
                @else
                <a class="story btn-play" data-story="{{ $index1->id }}" data-user="{{ $index1->user_id }}">
                    <div class="storyImg">
                        <img src="{{ Storage::url('media/default/avatar.png') }}" alt="" class="">
                    </div>
                    <h5 class="">{{ $story->nick }}</h5>
                </a>
                @endif
                @endforeach
                @endforeach
            </div>
        </div>
        <video class="d-none storyPlayer" width="100%" height="auto" id="storyPlay" controls>
            <source src="" id="mp4Source" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="bottom">
            <div class="innerBottom">
                @foreach($followings as $index)
                @foreach($index->userFollowing->images as $index1)
                <div class="post">
                    <div class="image">
                        <div class="pic">
                            <img src="{{ Storage::url('media/' . $index->following . '/library/images/' . $index1->filename) }}" alt="" class="">
                        </div>
                        <div class="bottom">
                            <div class="icons">
                                @if(count($index1->likes) > 0)
                                @foreach($index1->likes as $index2)
                                @php $i = 0; @endphp
                                @if($index1->id != $index2->image_id)
                                @php $i++; @endphp
                                @endif
                                @endforeach
                                @if((count($index1->likes) - 1) == $i)
                                <a href="" class=""><i data-id="{{ $index1->id }}" class="fa-regular fa-heart btn-like"></i></a>
                                @else
                                <a href="" class=""><i data-id="{{ $index1->id }}" class="fa-regular fa-heart btn-like like"></i></a>
                                @endif

                                @else
                                <a href="" class=""><i data-id="{{ $index1->id }}" class="fa-regular fa-heart btn-like"></i></a>
                                @endif
                                <i class="fa-solid fa-comment"></i>
                                <i class="fa-solid fa-paper-plane"></i>
                            </div>
                            <div class="likes">
                                <p class="countLikes">{{ count($index1->likes) }} likes</p>
                            </div>
                            <div class="imageName">
                                <p class="">
                                    <span class="" style="font-weight:bold;">{{ $index1->user->nick }}</span> {{ $index1->name}}
                                </p>
                            </div>
                            <div class="comments">
                                <div class="likesComments">
                                    @if(count($index1->comments) > 0)

                                    @foreach($index1->comments as $index3)
                                    <p class="">{{ $index3->content }}</p>

                                    @php $i = 0; @endphp
                                    @if($index1->id != $index3->image_id)
                                    @php $i++; @endphp
                                    @endif
                                    @php var_dump($index1->likesComments); @endphp
                                    @if($index1->likesComments != null)
                                    @if((count($index1->likesComments) - 1) == $i)
                                    <div class="innerLikesComments">
                                        <a href="" class=""><i data-id="{{ $index3->id }}" class="fa-regular fa-heart btn-likeComment"></i></a>
                                        <p class="countLikesComments">{{ count($index3->likesComments) }} likes</p>
                                    </div>
                                    @else
                                    <div class="innerLikesComments">
                                        <a href="" class=""><i data-id="{{ $index3->id }}" class="fa-regular fa-heart btn-likeComment likeComment"></i></a>
                                        <p class="countLikesComments">{{ count($index3->likesComments) }} likes</p>
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                    @else
                                    <div class="innerLikesComments">
                                        <p class="">Comenta algo...</p>
                                    </div>
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