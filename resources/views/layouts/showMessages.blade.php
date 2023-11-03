<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="{{ asset('css/styles.css'); }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/fontawesome.css'); }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css'); }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css'); }}" rel="stylesheet">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="showAllMessagesNav">
        <nav class="">
            <ul class="">
                <li class=""><a href="/{{ $nick }}/messages" class=""><i class="fa-solid fa-arrow-left"></i></a></li>
                <li class="avatarNick">
                    <div class="avatar">
                        @if($receiverAvatar != null && Storage::disk('profiles')->exists($receiver . '/' . $receiverAvatar))
                        <img src="{{ Storage::disk('profiles')->url($receiver . '/' . $receiverAvatar) }}" alt="" class="">
                        @else
                        <img src="{{ Storage::disk('profiles')->url('default/avatar.png') }}" alt="" class="">
                        @endif
                    </div>
                    <div class="">
                        <h4 class="">{{ $receiverNick }}</h4>
                    </div>
                </li>
                <li class=""><a href="{{ route('home') }}" class=""><i class="fa-regular fa-pen-to-square"></i></a></li>
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