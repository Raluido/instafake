@extends('layouts.profile')

@section('main')

<section class="">
    <div class="">
        <h3 class="">
            Panel de usuario
        </h3>
    </div>
    <div class="">
        <form action="{{ route('user.updateData', ['nick' => $nick, 'user' => $user->id]) }}" class="">
            @csrf
            <div class="">
                <label for="name" class="">Nombre</label>
                <input type="text" name="name" value="{{ $user->name }}" class="">
            </div>
            <div class="">
                <label for="surname" class="">Apellidos</label>
                <input type="text" name="surname" value="{{ $user->surname }}" class="">
            </div>
            <div class="">
                <label for="nick" class="">Nick</label>
                <input type="text" name="nick" value="{{ $user->nick }}" class="">
            </div>
            <div class="">
                <label for="password" class="">Contraseña</label>
                <input type="text" name="password" class="">
            </div>
            <div class="">
                <label for="repitePassword" class="">Repite Contraseña</label>
                <input type="text" name="repitePassword" class="">
            </div>
            <div class="">
                <label for="image" class="">Avatar</label>
                <input type="file" name="avatar" value="{{ $user->avatar }}" class="">
                @if(file_exists(public_path('profile/' . $user->id . '/' . $user->avatar)))
                <div class="">
                    <img src="{{ Storage::url('profile/' . $user->id . '/' . $user->avatar)) }}" alt="" class="">
                </div>
                @endif
            </div>
            <div class="">
                <input type="submit" class="" value="Actualizar">
            </div>

        </form>
    </div>

</section>


@endsection