@extends('layouts.master')

@section('main')
<h5>Mis mensajes</h5>

@foreach($messagesSended as $index)
{{ $index->content }}
{{ $index->content_reply }}
{{ $index->sender_id_reply }}
@endforeach



@endsection