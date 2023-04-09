<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Message;

class MessageController extends Controller
{
    public function showMessages($nick)
    {
        $id = auth()->id();

        $messages = Db::select("SELECT * FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY sender + receiver ORDER BY created_at) AS total FROM messages) t WHERE t.total = 1 AND (t.sender = $id OR t.receiver = $id)");

        return view('user.messages', compact('nick', 'messages', 'id'));
    }

    public function showMessage($nick, $receiver)
    {
        $id = auth()->id();

        $total = $id + $receiver;

        $messages = Db::select("SELECT * FROM (SELECT *, sender + receiver AS total FROM messages) t WHERE t.total = $total");

        foreach ($messages as $index) {
            $update = Db::table('messages')
                ->where('id', $index->id)
                ->update(['read' => 1]);
        }

        return view('user.message', compact('nick', 'id', 'messages', 'receiver'));
    }

    public function checkMessages()
    {
        $id = auth()->id();

        $messages = Db::table('messages')
            ->select('read')
            ->where('sender', $id)
            ->orWhere('receiver', $id)
            ->get();

        foreach ($messages as $index) {
            if ($index->read == 0) {
                return $result = false;
            } else {
                return $result = true;
            }
        }
    }

    public function searchUser($nick, $inputSearch)
    {
        $users = Db::table('users')
            ->select('nick')
            ->where('nick', 'LIKE', '%' . $inputSearch . '%')
            ->get();

        return $users;
    }

    public function sendMessage(Request $request)
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
}
