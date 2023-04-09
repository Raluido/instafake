@extends('layouts.auth')

@section('main')
<section class="login">
    <div class="innerLogin">
        <div class="imageLogin">
            <img src="{{ Storage::url('media/baseImgs/homePrev.png') }}" alt="" class="">
        </div>
        <div class="">
            <h2 class="">InstaFake</h2>
            <form action="{{ route('login.authenticate') }}" method="POST" class="">
                @csrf
                <label for="" class="">Email</label>
                <input type="text" name="email" class="">
                <label for="" class="">Password</label>
                <input type="password" name="password" class="">
                <input type="submit" value="Loguearse" class="">
            </form>
            <div class="">
                <p>No tienes una cuenta? <span><a href="{{ route('register.show') }}">Regístrate</a></span></p>
            </div>
        </div>
    </div>
</section>
@endsection