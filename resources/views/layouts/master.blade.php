<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css'); }}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <header class="">
        @include('layouts.partials.navbar')
    </header>
    <main class="">
        @yield('main')
    </main>
    <footer class="">
        @include('layouts.partials.footer')
    </footer>
</body>

</html>