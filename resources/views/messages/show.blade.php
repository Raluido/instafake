@extends('layouts.showMessages')

@section('main')

<section class="message">
    <div class="innerMessage">
        <div class="top">
            <h4>Mis mensajes</h4>
        </div>
        <div class="bottom">
            <div class="chat">
                <?php
                $counter = 0;
                foreach ($messages as $index) :
                    if ($counter == 0 || $id == $index->sender) :
                ?>
                        <div class="userMessageSender">
                            <div class="innerUserMessage">
                                <div class="">
                                    <p class="">{{ $index->content }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h5 class=""><?php
                                            if (isset($previousIndex)) {
                                                $previousTime = date_create($previousIndex->created_at);
                                                $presentTime = date_create($index->created_at);
                                                $interval = $previousTime->diff($presentTime);
                                                if ($interval->format("%i") > 30 && $interval->format("%a") == 0) {
                                                    echo $interval->format("%i minutos");
                                                } elseif ($interval->format("%a") != 0) {
                                                    echo date_format($presentTime, "d M, H:i");
                                                }
                                            }

                                            ?></h5>
                        </div>
                    <?php
                    else :
                    ?>
                        <div class="userMessageReceiver">
                            <div class="innerUserMessage">
                                <div class="">
                                    <p class="">{{ $index->content }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h5 class=""><?php
                                            if (isset($previousIndex)) {
                                                $previousTime = date_create($previousIndex->created_at);
                                                $presentTime = date_create($index->created_at);
                                                $interval = $previousTime->diff($presentTime);
                                                if ($interval->format("%i") > 30 && $interval->format("%a") == 0) {
                                                    echo $interval->format("%i minutos");
                                                } elseif ($interval->format("%a") != 0) {
                                                    echo date_format($presentTime, "d M, H:i");
                                                }
                                            }

                                            ?></h5>
                        </div>
                <?php
                    endif;
                    $counter++;
                    $previousIndex = $index;
                endforeach;
                ?>
            </div>
            <form action="{{ route('messages.send', $nick) }}" method=POST class="">
                @csrf
                <input type="hidden" name="receiver" value="{{ $receiver }}" class="">
                <textarea name="content" id="textarea" wrap="hard" data-min-rows='2' class="replyInput textarea autoExpand"></textarea>
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