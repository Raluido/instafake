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
    <header class="">
        @include('layouts.partials.navbarMsg')
    </header>
    <main class="">
        @yield('main')
    </main>
    <footer class="">
        @include('layouts.partials.footer')
    </footer>
</body>

@yield('js')

</html>