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
                        <div class="userMessage" style="margin:2em;">
                            <p class="">{{ $index->content }}</p>
                        </div>
                    <?php
                    elseif ($id == $index->receiver) :
                    ?>
                        <div class="userMessage" style="margin:2em; display:flex; justify-content:end;">
                            <p class="" style="display:inline-block">{{ $index->content }}</p>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
            <form action="{{ route('user.sendMessage', $nick) }}" method=POST class="">
                @csrf
                <input type="hidden" name="receiver" value="{{ $receiver }}" class="">
                <textarea name="" id="textarea" data-min-rows='2' class="replyInput textarea autoExpand"></textarea>
                <input type="submit" value="enviar" class="">
            </form>
        </div>
    </div>
</section>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/growInput.js') }}" defer></script>
@endsection