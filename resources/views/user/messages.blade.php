@extends('layouts.master')

@section('main')
<h5>Mis mensajes</h5>

<div class="" style="margin-top: 6em;">
    @foreach($messages as $index)
    <a href="{{ route('user.showMessage', [$nick,$index->id]) }}" class="">
        <div class="" style="margin:2em;">
            <p class="" style="border:1px solid gray; background-color:lightseagreen; display:inline;">{{ $index->content }} -> Mensaje </p>
        </div>
    </a>
    @endforeach
</div>

@endsection