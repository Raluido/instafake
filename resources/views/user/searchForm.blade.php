@extends('layouts.profile')

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
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/searchUsers.js') }}" defer></script>
@endsection