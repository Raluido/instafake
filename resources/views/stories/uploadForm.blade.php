@extends('layouts.justBack')

@section('main')
<section class="uploadForm disable">
    <h2>Editar y publicar</h2>
    <div class="">

        <form action="{{ route('stories.store', $nick) }}" method="POST" enctype="multipart/form-data" class="">
            @csrf
            <input type="hidden" name="nick" placeholder="{{ $nick }}" class="">
            <input type="file" name="videoFile" placeholder="Añade un video" class="">
            <input type="submit" value="Publicar" class="">
        </form>

    </div>

</section>
@endsection