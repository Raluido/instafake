@extends('layouts.slave')

@section('main')

<section class="message">
    <div class="innerMessage">
        <div class="top">
            <h5>Mis mensajes</h5>
        </div>
        <div class="bottom">
            <div class="chat">
                <?php
                $counter = 0;
                foreach ($messages as $index) :
                    $counter++;
                    if ($id == $index->sender || $counter == 0) :
                ?>
                        <div class="" style="margin:2em;">
                            <p class="" style="border:1px solid gray; background-color:lightseagreen; display:inline;">{{ $index->content }} -> Mensaje </p>
                        </div>
                    <?php
                    elseif ($id == $index->receiver) :
                    ?>
                        <div class="" style="margin:2em; display:flex; justify-content:end;">
                            <p class="" style="border:1px solid gray; background-color:lightseagreen; display:inline;">{{ $index->content }} -> Mensaje </p>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
            <form action="{{ route('user.sendMessage', $nick) }}" method=POST class="">
                @csrf
                <input type="hidden" name="receiver" value="{{ $receiver }}" class="">
                <p class=""><textarea name="content" class="replyInput textarea resize-ta"></textarea></p>
                <input type="submit" value="enviar" class="">
            </form>
        </div>
    </div>
</section>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/growInput.js') }}" defer></script>
@endsection