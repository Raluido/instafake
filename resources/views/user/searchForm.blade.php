@extends('layouts.profile')

@section('main')

<section class="myProfile">
    <div class="innerMyProfile">
        <div class="top">
            <div class="innerTop">
                <form action="" class="">
                    <input type="text" id="searchId" class="" oninput="searchUsers()">
                    <div class="resultsClass d-none" id="resultsId"></div>
                </form>
            </div>
        </div>
        <div class="bottom">
            <div class="innerBottom">
            </div>
        </div>
    </div>
</section>

@endsection