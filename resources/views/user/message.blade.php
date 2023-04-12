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
                    if ($counter == 0 || $id == $index->sender) :
                ?>
                        <div class="userMessage">
                            <div class="innerUserMessage">
                                <p class="">{{ $index->content }}</p>
                            </div>
                        </div>
                        <div class="">
                            <h5 class="">{{ $index->created_at }}</h5>
                        </div>
                    <?php
                    else :
                    ?>
                        <div class="userMessage" style="display:flex; justify-content:end;">
                            <div class="innerUserMessage">
                                <p class="">{{ $index->content }}</p>
                            </div>
                        </div>
                        <div class="">
                            <h5 class="">{{ $index->created_at }}</h5>
                        </div>
                <?php
                    endif;
                    $counter++;
                endforeach;
                ?>
            </div>
            <form action="{{ route('user.sendMessage', $nick) }}" method=POST class="">
                @csrf
                <input type="hidden" name="receiver" value="{{ $receiver }}" class="">
                <textarea name="content" id="textarea" data-min-rows='2' class="replyInput textarea autoExpand"></textarea>
                <input type="submit" id="sendMessageId" value="enviar" class="d-none">
            </form>
        </div>
    </div>
</section>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/growInput.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/scrollDown.js') }}" defer></script>
@endsection