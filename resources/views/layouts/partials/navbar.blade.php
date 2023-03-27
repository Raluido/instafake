<header class="">
    <nav class="">
        <div class="">
            <div class="">
                <h3>InstaFake</h3>
            </div>
        </div>
        <div class="innerNavR">
            <div class="">Mis likes</div>
            <?php

            use App\Models\User;
            use Illuminate\Support\Facades\Session;

            $id = auth()->id();
            Session::push('user', [
                'user_id' => $id
            ]);

            $nick = User::where('id', $id)
                ->value('nick');
            ?>
            <div class=""><a href="{{ route('user.messages', $nick) }}" class="">Mensajes</a></div>
        </div>
    </nav>
</header>