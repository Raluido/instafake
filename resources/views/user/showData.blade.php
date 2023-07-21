@extends('layouts.profile')

@section('main')

<section class="updateProfile">
    <div class="innerUpdateProfile">
        <div class="top">
            <h2 class="">
                Panel de usuario
            </h2>
        </div>
        <div class="">
            @include('layouts.partials.messages')
        </div>
        <div class="bottom">
            <form action="{{ route('user.updateData', ['nick' => $nick]) }}" enctype="multipart/form-data" method="post" class="">
                @csrf
                <div class="inputDiv">
                    <label for="name" class="">Nombre</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="">
                </div>
                <div class="inputDiv">
                    <label for="surname" class="">Apellidos</label>
                    <input type="text" name="surname" value="{{ $user->surname }}" class="">
                </div>
                <div class="inputDiv">
                    <label for="nick" class="">Nick</label>
                    <input type="text" name="nick" value="{{ $user->nick }}" class="">
                </div>
                <div class="inputDiv">
                    <label for="password" class="">Contraseña</label>
                    <input type="password" name="password" class="">
                </div>
                <div class="inputDiv">
                    <label for="password_confirmation" class="">Repite Contraseña</label>
                    <input type="password" name="password_confirmation" class="">
                </div>
                <div class="inputDiv">
                    <label for="avatar" class="">Avatar</label>
                    <input type="file" name="avatar" value="{{ $user->avatar }}" class="">
                </div>
                <div class="submitDiv">
                    <input type="submit" class="" value="Actualizar">
                </div>
            </form>

            @if($user->image != null && file_exists(public_path('profiles/' . $user->id . '/' . $user->image)))
            <div class="avatarThumbnail">
                <div class="innerAvatarThumbnail">
                    <img src="{{ Storage::disk('profiles')->url($user->id . '/' . $user->image) }}" alt="" class="">
                </div>
                <div class="innerAvatarThumbnailDel">
                    <form action="{{ route('user.deleteAvatar', ['nick' => $nick]) }}" method="post" class="">
                        @csrf
                        <input type="submit" class="" value="x">
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>


@endsection