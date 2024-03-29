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
    <header class="myProfileNav">
        <nav class="">
            <ul class="">
                <li class=""><a href="{{ route('home') }}" class=""><i class="fa-solid fa-arrow-left"></i></a></li>
                <li class="">
                    <h4 class="">{{ $nick }}</h4>
                </li>
                <li class="dropDownMenu" onclick="openMenu()"><i class="fa-regular fa-gear"></i></a></li>
            </ul>
        </nav>
        <div class="dropDown d-none">
            <a href="{{ route('user.showData', ['nick' => $nick]) }}" class="">Datos de usuario</a>
            <a href="{{ route('logout.perform') }}" class="">Logout</a>
        </div>
    </header>
    <main class="">
        @yield('main')
    </main>
</body>

<script class="" type="text/javascript" src="{{ asset('js/openMenu.js') }}"></script>
@yield('js')

</html>