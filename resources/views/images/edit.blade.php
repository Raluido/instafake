@extends('layouts.editImage')

@section('main')
<section class="editImage">
    <div class="innerEditImage">
        <div class="top">
            <div class="icon">
                @if($image->user->image != null && file_exists('profiles/' . $image->user->id . '/' . $image->user->image))
                <img src="{{ Storage::disk('profiles')->url($image->user->id . '/' . $image->user->image) }}" alt="" class="">
                @else
                <img src="{{ Storage::disk('profiles')->url('default/avatar.png') }}" alt="" class="">
                @endif
            </div>
            <div class="info">
                <div class="name">
                    <h5 class="">
                        {{ $image->user->nick }}
                    </h5>
                </div>
                <div class="place">
                    <form action="{{ route('images.edit', $nick) }}" id="sendImageEdited" method="post" class="">
                        @csrf
                        <input type="hidden" value="{{ $image->id }}" name="imageId" class="">
                        <input type="text" value="{{ $image->location }}" name="location" class="">
                        <input type="submit" class="d-none">
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="pic">
                <img src="{{ Storage::disk('images')->url($image->user->id . '/' . $image->filename) }}" alt="" class="">
            </div>
            <div class="">
                <input type="text" value="{{ $image->name }}" name="name" class="">
                <input type="submit" class="d-none">
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/sendUpdates.js') }}" defer></script>
@endsection