@extends('layouts.slave')

@section('main')
<section class="messages">
    <div class="innerMessages">
        <h5>Mis mensajes</h5>
        <input type="hidden" id="nickId" class="" value="{{ $nick }}">
        <div class="">
            <label for="" class="">Buscar</label>
            <input type="text" id="searchId" class="" oninput="searchUsers()">
            <div class="resultsClass d-none" id="resultsId"></div>
        </div>
        <div class="" style="margin-top: 6em;">
            @foreach($messages as $index)
            @if($id != $index->sender)
            <a href="{{ route('user.showMessage', [$nick,$index->sender]) }}" class="">
                <div class="" style="margin:2em;">
                    <p class="" style="border:1px solid gray; background-color:lightseagreen; display:inline;">{{ $index->content }} -> Mensaje </p>
                </div>
            </a>
            @else
            <a href="{{ route('user.showMessage', [$nick,$index->receiver]) }}" class="">
                <div class="" style="margin:2em;">
                    <p class="" style="border:1px solid gray; background-color:lightseagreen; display:inline;">{{ $index->content }} -> Mensaje </p>
                </div>
            </a>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/searchUsers.js') }}" defer></script>
@endsection