@extends('layouts.justBack')

@section('main')
<section class="addStoryForm">
    <h2>Añadir story</h2>
    <div class="addStoryFormInner">
        <div class="">
            @include('layouts.partials.messages')
        </div>
        <form action="{{ route('stories.store', $nick) }}" method="POST" enctype="multipart/form-data" class="">
            @csrf
            <input type="hidden" name="nick" placeholder="{{ $nick }}" class="">
            <div class="inputDiv">
                <input type="file" name="videoFile" placeholder="Añade un video" class="">
            </div>
            <div class="submitDiv">
                <input type="submit" value="Publicar" class="">
            </div>
        </form>
    </div>
</section>
@endsection