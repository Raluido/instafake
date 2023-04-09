@extends('layouts.auth')

@section('main')
<section class="register">
    <div class="innerRegister">
        <div class="top">
            <h3 class="">Registro de usuarios</h3>
        </div>
        <div class="bottom">
            <form action="{{ route('register.store') }}" method="POST" class="">
                @csrf
                <div class="inputForm">
                    <label for="nick" class="">Nick</label>
                    <input type="text" id="nick" name="nick">
                </div>
                <div class="inputForm">
                    <label for="email" class="">Email</label>
                    <input type="email" name="email">
                </div>
                <div class="inputForm">
                    <label for="password" class="">Password</label>
                    <input type="password" name="password">
                </div>
                <div class="inputForm">
                    <label for="password_confirmation" class="">Repite el password</label>
                    <input type="password" name="password_confirmation">
                </div>
                <div class="submitForm">
                    <input type="submit" value="Registrar">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection