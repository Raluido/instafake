@extends('layouts.master')

@section('main')
<h5>Mi instragram</h5>


@foreach($images as $image)
<img src="{{ Storage::url('storage/media/' . $id . '/images/' . $image) }}" alt="" class="">
@endforeach

@endsection