@extends('layouts.slave')

@section('main')
<?php

use App\Models\User;
?>
<section class="messages">
    <div class="innerMessages">
        <div class="top">
            <h4>Mis mensajes</h4>
            <input type="hidden" id="nickId" class="" value="{{ $nick }}">
            <div class="">
                <label for="" class="">Buscar</label>
                <input type="text" id="searchId" class="" oninput="searchUsers()">
                <div class="resultsClass d-none" id="resultsId"></div>
            </div>
        </div>
        <div class="bottom">
            @foreach($messages as $index)
            @if($id != $index->sender)
            <a href="{{ route('user.showMessage', [$nick,$index->sender]) }}" class="">
                <div class="userMessage">
                    <?php
                    $avatar = User::find($index->sender);
                    ?>
                    <div class="profile">
                        <img src="{{ Storage::url($avatar->image) }}" alt="" class="">
                    </div>
                    <div class="content">
                        <h4 class="">{{ $avatar->nick }}</h4>
                        <h5 class="">{{ $index->content }}</h5>
                    </div>
                </div>
            </a>
            @else
            <a href="{{ route('user.showMessage', [$nick,$index->receiver]) }}" class="">
                <div class="userMessage" style="margin:2em;">
                    <?php
                    $avatar = User::find($index->receiver);
                    ?>
                    <div class="profile">
                        <img src="{{ Storage::url($avatar->image) }}" alt="" class="">
                    </div>
                    <div class="content">
                        <h4 class="">{{ $avatar->nick }}</h4>
                        <h5 class="">{{ $index->content }}</h5>
                    </div>
                </div>
            </a>
            @endif
            @endforeach
        </div>
    </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/searchUsers.js') }}" defer></script>
@endsection