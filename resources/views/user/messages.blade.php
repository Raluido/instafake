@extends('layouts.slave')

@section('main')
<section class="messages">
    <h5>Mis mensajes</h5>
    <input type="hidden" id="inputNick" class="" value="{{ $nick }}">
    <div class="">
        <label for="" class="">Buscar</label>
        <input type="text" id="inputSearch" class="" oninput="searchUsers()">
    </div>
    <div class="" style="margin-top: 6em;">
        @foreach($messages as $index)
        <a href="{{ route('user.showMessage', [$nick,$index->id]) }}" class="">
            <div class="" style="margin:2em;">
                <p class="" style="border:1px solid gray; background-color:lightseagreen; display:inline;">{{ $index->content }} -> Mensaje </p>
            </div>
        </a>
        @endforeach
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/searchUsers.js') }}" defer></script>
@endsection