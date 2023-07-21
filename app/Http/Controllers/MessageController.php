<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Message;
use App\Models\User;
use App\Models\Image;
use Mockery\Undefined;

class MessageController extends Controller
{
    public function showAll($nick)
    {
        $id = auth()->id();

        $messages = Db::select("SELECT * FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY sender + receiver ORDER BY created_at DESC) AS total FROM messages) t WHERE t.total = 1 AND (t.sender = $id OR t.receiver = $id)");

        return view('messages.showAll', compact('nick', 'messages', 'id'));
    }

    public function show($nick, $receiver)
    {
        $id = auth()->id();
        $total = $id + $receiver;

        $receiverNick = User::where('id', $receiver)
            ->value('nick');

        $messages = Db::select("SELECT * FROM (SELECT *, sender + receiver AS total FROM messages) t WHERE t.total = $total");

        foreach ($messages as $index) {
            $update = Db::table('messages')
                ->where('id', $index->id)
                ->where('receiver', $id)
                ->update(['read' => 1]);
        }

        return view('messages.show', compact('nick', 'messages', 'receiver', 'receiverNick'));
    }

    public function check()
    {
        $id = auth()->id();

        $messages = Db::table('messages')
            ->select('read')
            ->Where('receiver', $id)
            ->get();

        $count = 0;

        if ($messages) {
            foreach ($messages as $index) {
                if ($index->read == 0) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function search($nick, $inputSearch)
    {
        $users = Db::table('users')
            ->join('followers', 'users.id', '=', 'followers.following')
            ->where('followers.follower', '=', auth()->id())
            ->where('users.nick', 'LIKE', '%' . $inputSearch . '%')
            ->get();

        return $users;
    }


    public function send(Request $request)
    {
        $id = auth()->id();

        $message = new Message();
        $message->sender = $id;
        $message->receiver = $request->receiver;
        $message->read = false;
        $message->content = $request->content;
        $message->save();

        return back();
    }

    public function sendLinks($nick, $inputSearch, Image $image)
    {
        $id = auth()->id();

        $imageId = $image->id;

        return ['users' => $users, 'image' => $image];
    }
}
