<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css'); }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/fontawesome.css'); }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css'); }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css'); }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <header class="commentsNav">
        <nav class="">
            <ul class="">
                <li class="backHome"><a href="{{ route('home', $nick) }}" class=""><i class="fa-solid fa-arrow-left"></i></a></li>
                <li class="comments">Comentarios</li>
            </ul>
        </nav>
    </header>
    <main class="">
        @yield('main')
    </main>
</body>
<script class="" type="text/javascript" src="{{ asset('js/jquery-3.6.4.js') }}"></script>
@yield('js')

</html>