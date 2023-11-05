@extends('layouts.publications')

@section('main')

<section class="explore">
    <div class="">
        @include('layouts.partials.messages')
    </div>
    <div class="innerExplore">
        @foreach($images as $image)
        <div class="post">
            <div class="image">
                <div class="top publications">
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
                    <div class="imageOptions">
                        <div class="innerImageOptions" id="id{{ $image->id }}">
                            <div class="menuImage">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                            <div class="links d-none" id="id{{ $image->id }}">
                                <a href="{{ route('images.editForm', ['nick' => $nick, 'imageId' => $image->id]) }}" class="">Editar</a>
                                <form action="{{ route('images.delete', ['nick' => $nick, 'imageId' => $image->id]) }}" method="post" class="">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="" value="Eliminar">
                                </form>
                            </div>
                        </div>
                    </div>
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
<script type="text/javascript" src="{{ asset('js/getLike.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/imageOptionsMenu.js') }}" defer></script>
@endsection