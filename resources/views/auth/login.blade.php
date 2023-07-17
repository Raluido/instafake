@extends('layouts.auth')

@section('main')
<section class="login">
    <div class="innerLogin">
        <div class="imageLogin">
            <img src="{{ Storage::url('baseImgs/homePrev.png') }}" alt="" class="">
        </div>
        <div class="">
            <div class="">
                @include('layouts.partials.messages')
            </div>
            <h2 class="">InstaFake</h2>
            <form action="{{ route('login.authenticate') }}" method="POST" class="">
                @csrf
                <div class="inputForm">
                    <label for="" class="">Email</label>
                    <input type="text" name="email" class="">
                </div>
                <div class="inputForm">
                    <label for="" class="">Password</label>
                    <input type="password" name="password" class="">
                </div>
                <div class="submitForm">
                    <input type="submit" value="Loguearse" class="">
                </div>
            </form>
            <div class="">
                <p>No tienes una cuenta? <span><a href="{{ route('register.show') }}">Regístrate</a></span></p>
            </div>
        </div>
    </div>
</section>
@endsection