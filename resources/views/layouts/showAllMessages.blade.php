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
    @vite('resources/js/app.js')
</head>

<body>
    <header class="showAllMessagesNav">
        <nav class="">
            <ul class="">
                <li class=""><a href="{{ route('home') }}" class=""><i class="fa-solid fa-arrow-left"></i></a></li>
                <li class="">
                    <h4 class="">{{ $nick }}</h4>
                </li>
                <li class=""><a href="{{ route('home') }}" class=""><i class="fa-regular fa-pen-to-square"></i></a></li>
            </ul>
        </nav>
    </header>
    <main class="">
        @yield('main')
    </main>
</body>

@yield('js')

</html>