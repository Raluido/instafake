    <nav class="navbarMaster">
        <div class="logo">
            <img src="{{ Storage::url('baseImgs/instaFakeBg.png') }}" alt="" class="">
        </div>
        <div class="likesAndMsg">
            <div class="likesPage"><a href="" class=""><i class="fa-solid fa-heart"></i></a></div>
            <div class="msg">
                <a href="{{ route('messages.showAll', $nick) }}" class="">
                    <i class="fa-solid fa-paper-plane" id="messageIcon"></i>
                    <div class="countMsg">
                        <p class="innerCountMsg" id="innerCountMsg"></p>
                    </div>
                </a>
            </div>
        </div>
    </nav>