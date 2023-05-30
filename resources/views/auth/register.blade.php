@extends('layouts.auth')

@section('main')
<section class="register">
    <div class="innerRegister">
        <div class="top">
            <h3 class="">Registro de usuarios</h3>
        </div>
        <div class="bottom">

            <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" class="">
                @csrf
                <div class="inputForm">
                    <label for="nick" class="">Nick</label>
                    <input type="text" id="nick" name="nick">
                    @if($errors->has('nick'))
                    <span class="danger">{{ $errors->first() }}</span>
                    @endif
                </div>
                <div class="inputForm">
                    <label for="email" class="">Email</label>
                    <input type="email" name="email">
                    @if($errors->has('email'))
                    <span class="danger">{{ $errors->first() }}</span>
                    @endif
                </div>
                <div class="inputForm">
                    <label for="image" class="">Avatar</label>
                    <input type="file" name="image">
                    @if($errors->has('image'))
                    <span class="danger">{{ $errors->first() }}</span>
                    @endif
                </div>
                <div class="inputForm">
                    <label for="password" class="">Password</label>
                    <input type="password" name="password">
                    @if($errors->has('password'))
                    <span class="danger">{{ $errors->first() }}</span>
                    @endif
                </div>
                <div class="inputForm">
                    <label for="password_confirmation" class="">Repite el password</label>
                    <input type="password" name="password_confirmation">
                    @if($errors->has('password_confirmation'))
                    <span class="danger">{{ $errors->first() }}</span>
                    @endif
                </div>
                <div class="submitForm">
                    <input type="submit" value="Registrar">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection