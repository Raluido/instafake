@extends('layouts.showAllMessages')

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
                <input type="text" id="searchId" class="" oninput="searchUsersMsj()">
                <div class="resultsClass d-none" id="resultsId"></div>
            </div>
        </div>
        <div class="bottom">
            @foreach($messages as $message)
            @if(auth()->id() != $message->sender)
            <a href="{{ route('messages.show', [$nick,$message->sender]) }}" class="">
                <div class="userMessage">
                    @php
                    $user = User::find($message->sender);
                    @endphp
                    <div class="profile">
                        <img src="{{ route('user.avatar', ['nick' => $nick, 'filename' => $message->userSender->image, 'id' => $user->id]) }}" alt="" class="">
                    </div>
                    <div class="content">
                        <h4 class="">{{ $user->nick }}</h4>
                        <div class="innerContent">
                            <?php
                            if (substr($message->content, 0, 4) == '<div') :
                            ?>
                                <div class="">
                                    <p>Has recibido una imágen</p>
                                </div>
                            <?php
                            else :
                            ?>
                                <div class="">
                                    <p>Has recibido un mensaje</p>
                                </div>
                            <?php
                            endif;
                            ?>
                            <div class="">
                                <h6 class="">
                                    {{ \FormatTime::LongTimeFilter($message->created_at) }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @else
            <a href="{{ route('messages.show', [$nick,$message->receiver]) }}" class="">
                <div class="userMessage">
                    @php
                    $user = User::find($message->receiver);
                    @endphp
                    <div class="profile">
                        <img src="{{ route('user.avatar', ['nick' => $nick, 'filename' => $user->image, 'id' => $user->id]) }}" alt="" class="">
                    </div>
                    <div class="content">
                        <h4 class="">{{ $user->nick }}</h4>
                        <div class="innerContent">
                            <?php
                            if (substr($message->content, 0, 4) == '<div') :
                            ?>
                                <div class="">
                                    <p>Has enviado una imágen</p>
                                </div>
                            <?php
                            else :
                            ?>
                                <div class="">
                                    <p>Has enviado un mensaje</p>
                                </div>
                            <?php
                            endif;
                            ?>
                            <div class="">
                                <h6 class="">
                                    {{ \FormatTime::LongTimeFilter($message->created_at) }}
                                </h6>
                            </div>
                        </div>
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
<script type="text/javascript" src="{{ asset('js/searchUsersMsj.js') }}" defer></script>
@endsection