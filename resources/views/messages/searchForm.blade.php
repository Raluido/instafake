@extends('layouts.justBack')

@section('main')

<section class="searchForm">
    <div class="innerSearchForm">
        <div class="top">
            <div class="innerTop">
                <input type="hidden" id="nickId" value="{{ $nick }}">
                <input type="hidden" id="imageId" value="{{ $imageId }}">
                <input type="text" id="searchId" class="" placeholder="Buscar" oninput="searchUsersLinks()">
                <div class="resultsClass d-none" id="resultsId"></div>
            </div>
        </div>
        <div class="bottom">
            <div class="innerBottom">
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/searchUsersLinks.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/callAjax.js') }}" defer></script>
@endsection