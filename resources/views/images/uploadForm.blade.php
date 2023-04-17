@extends('layouts.noHeaderFooter')

@section('main')
<section class="uploadForm disable">
    <h2>Editar y publicar</h2>
    <div class="wrapper">
        <div class="editor-panel">
            <div class="filter">
                <label class="title">Filtros</label>
                <div class="options">
                    <button id="brightness" class="active">Brightness</button>
                    <button id="saturation">Saturation</button>
                    <button id="inversion">Inversion</button>
                    <button id="grayscale">Grayscale</button>
                </div>
                <div class="slider">
                    <div class="filter-info">
                        <p class="name">Brighteness</p>
                        <p class="value">100%</p>
                    </div>
                    <input type="range" value="100" min="0" max="200">
                </div>
            </div>
            <div class="rotate">
                <label class="title">Rotate & Flip</label>
                <div class="options">
                    <button id="left"><i class="fa-solid fa-rotate-left"></i></button>
                    <button id="right"><i class="fa-solid fa-rotate-right"></i></button>
                    <button id="horizontal"><i class='bx bx-reflect-vertical'></i></button>
                    <button id="vertical"><i class='bx bx-reflect-horizontal'></i></button>
                </div>
            </div>
        </div>
        <div class="preview-img">
            <img src="image-placeholder.svg" alt="preview-img">
        </div>
    </div>
    <div class="controls">
        <button class="reset-filter">Reset Filters</button>
        <div class="row">
            <input type="file" class="file-input" accept="image/*" hidden>
            <input type="hidden" id="nick" value="{{ $nick }}" class="">
            <button class="choose-img">Seleccionar imagen</button>
            <button class="save-img">Nueva publicación</button>
        </div>
    </div>
</section>
@endsection
@section('js')
<script class="" type="text/javascript" src="{{ asset('js/editImages.js') }}"></script>
@endsection