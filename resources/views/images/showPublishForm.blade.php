@extends('layouts.noHeaderFooter')

@section('main')
<section class="publishForm">
    <div class="innerPublish">
        <div class="top">
            <h2>Publicar</h2>
        </div>
        <div class="bottom">
            <form action="{{ route('images.published', $nick) }}" method="POST" class="">
                @csrf
                <input type="hidden" value="{{ $fileName }}" name="fileName" class="">
                <div class="inputForm">
                    <label for="" class="">Nombre</label>
                    <input type="text" name="name" class="">
                </div>
                <div class="inputForm">
                    <label for="" class="">Lugar</label>
                    <input type="text" name="location" class="">
                </div>
                <!-- <div class="inputForm">
                    <label for="" class="">Etiqueta a quien tu quieras</label>
                    <input type="text" name="labels" class="">
                </div> -->
                <div class="submitForm">
                    <input type="submit" value="Publicar" class="">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection