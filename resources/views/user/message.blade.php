@extends('layouts.slave')

@section('main')

<section class="message">
    <h5>Mis mensajes</h5>

    <div class="" style="margin-top: 6em;">
        @foreach($messages as $index)
        <div class="" style="margin:2em;">
            <p class="" style="border:1px solid gray; background-color:lightseagreen; display:inline;">{{ $index->content }} -> Mensaje </p>
        </div>
        @foreach($replies as $index1)
        @if($index->id == $index1->id)
        <div class="" style="margin:2em;">
            @if($index1->sender_id_reply != $id)
            <p class="" style="border:1px solid gray; background-color:lightgreen; display:inline;">{{ $index1->content_reply }} -> Respuesta </p>
            @else
            <p class="" style="border:1px solid gray; background-color:lightseagreen; display:inline;">{{ $index1->content_reply }} -> Respuesta </p>
            @endif
        </div>
        @endif
        @endforeach
        @endforeach
    </div>

</section>
@endsection