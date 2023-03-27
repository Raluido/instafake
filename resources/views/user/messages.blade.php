@extends('layouts.master')

@section('main')
<h5>Mis mensajes</h5>

@foreach($messages as $message)
{{ $message->id }}
@endforeach



@endsection