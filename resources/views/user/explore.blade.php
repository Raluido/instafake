@extends('layouts.explore')

@section('main')

<section class="explore">
    <div class="innerExplore">
        @foreach($images as $image)
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
                    @php
                    $i = 0;
                    @endphp
                    @foreach($image->user->followings as $following)
                    @if($following->follower == auth()->id())
                    @php
                    $i++;
                    @endphp
                    @endif
                    @endforeach
                    @if(auth()->id() != $image->user->id)
                    @if($i == 1)
                    <form action="{{ route('user.unfollow', [$nick, $image->user->id]) }}" id="formId" method="post" class="unfollow">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="following" id="followingId" value="{{ $image->user->id }}" class="">
                        <input type="submit" value="Dejar de seguir" class="inputSubmit">
                    </form>
                    @else
                    <form action="{{ route('user.follow', $nick) }}" id="formId" class="follow" method="post">
                        @csrf
                        <input type="hidden" name="following" id="followingId" value="{{ $image->user->id }}" class="">
                        <input type="hidden" id="nickName" value="{{ $nick }}" class="">
                        <input type="submit" value="Seguir" class="inputSubmit">
                    </form>
                    @endif
                    @endif
                </div>
                <div class="pic">
                    <img src="{{ Storage::disk('images')->url($image->user->id . '/' . $image->filename) }}" alt="" class="">
                </div>
                <div class="bottom">
                    <div class="icons">
                        @if(count($image->likes) > 0)
                        @foreach($image->likes as $like)
                        @php $i = 0; @endphp
                        @if(auth()->id() != $like->giver)
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
                            @else
                            <form action="{{ route('comments.store', $nick) }}" method="post" class="">
                                @csrf
                                <textarea placeholder="Añade un comentario..." name="content" id="textarea" rows="1" style="width: 100%;"></textarea>
                                <input type="hidden" name="imageId" value="{{ $image->id }}" class="">
                                <input type="submit" id="sendMessageId" value="enviar" class="d-none">
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <input type="hidden" class="" id="inputNick" value="{{ $nick }}">
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/checkFollows.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/getLike.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/sendComment.js') }}" defer></script>
@endsection