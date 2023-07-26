@extends('layouts.justBack')

@section('main')

<section class="searchForm">
    <div class="innerSearchForm">
        <div class="top">
            <div class="innerTop">
                <input type="hidden" id="nickId" value="{{ $nick }}">
                <input type="text" id="searchId" class="" placeholder="Buscar" oninput="searchUsers()">
                <div class="resultsClass d-none" id="resultsId"></div>
            </div>
        </div>
        <div class="bottom">
            <div class="innerBottom">
                @foreach($images as $image)
                <div class="image">
                    <a href="{{ route('user.explore', ['nick' => $nick, 'imageId' => $image->id]) }}" class=""><img src="{{ Storage::disk('images')->url($image->user->id . '/' . $image->filename) }}" alt="" class=""></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/searchUsers.js') }}" defer></script>
@endsection