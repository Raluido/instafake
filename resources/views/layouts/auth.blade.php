<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main class="">
        <section class="">
            <div class="">
                <div class="">
                    <img src="{{ asset('media/baseImgs/homePrev.png }}" alt="" class="">
                </div>
                <div class="">
                    <h4 class="">Loguin</h4>
                    <form action="{{ route('loguin') }}" method="POST" class="">
                        <label for="" class=""></label>
                        <input type="text" class="">
                        <label for="" class=""></label>
                        <input type="text" class="">
                    </form>
                </div>
            </div>
            <div class="">
                <p>No tienes una cuenta? <span><a href="{{ route('register') }}">Regístrate</a></span></p>
            </div>
        </section>
    </main>
</body>

</html>