<div class="">
    <h2 class="">Registro de usuarios</h2>
</div>
<div class="">
    <form action="{{ route('register.store') }}" method="POST" class="">
        @csrf
        <div class="">
            <label for="nick" class="">Nick</label>
            <input type="text" id="nick" name="nick">
        </div>
        <div class="">
            <label for="email" class="">Email</label>
            <input type="email" name="email">
        </div>
        <div class="">
            <label for="password" class="">Password</label>
            <input type="password" name="password">
        </div>
        <div class="">
            <label for="password_confirmation" class="">Repite el password</label>
            <input type="password" name="password_confirmation">
        </div>
        <div class="">
            <input type="submit" value="Registrar">
        </div>
    </form>
</div>