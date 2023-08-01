<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/styles.css'); }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/fontawesome.css'); }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css'); }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css'); }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <header class="exploreNav">
        <nav class="">
            <ul class="">
                <li class=""><a href="{{ route('user.profile', ['nick' => $nick, 'userId' => auth()->id()]) }}" class=""><i class="fa-solid fa-arrow-left"></i></a></li>
                <li class="">
                    <h4 class="">Publicaciones</h4>
                </li>
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