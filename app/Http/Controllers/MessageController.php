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

        $messages = Db::table('messages')
            ->where('sender_id', $id)
            ->orWhere('receiver_id', $id)
            ->get();

        return view('user.messages', compact('nick', 'id', 'messages'));
    }

    public function showMessage($nick, $id)
    {
        $messages = Db::table('messages')
            ->where('id', $id)
            ->get();

        $replies = Db::table('messages')
            ->select('messages.id', 'replies.content_reply', 'replies.sender_id_reply')
            ->join('replies', 'messages.id', '=', 'replies.message_id')
            ->where('messages.id', $id)
            ->get();

        $message = Message::find($id);
        $message->read = true;
        $message->save();

        Db::table('replies')
            ->where('message_id', $id)
            ->update(['read' => true]);


        return view('user.message', compact('nick', 'id', 'messages', 'replies'));
    }

    public function checkMessages()
    {
        $id = auth()->id();

        $messages = Db::table('messages')
            ->select('read')
            ->where('sender_id', $id)
            ->orWhere('receiver_id', $id)
            ->get();

        foreach ($messages as $index) {
            if ($index->read == 0) {
                return $result = false;
            }
        }

        $replies = Db::table('messages')
            ->select('replies.read')
            ->join('replies', 'messages.id', '=', 'replies.message_id')
            ->where('messages.id', $id)
            ->get();

        foreach ($replies as $index) {
            if ($index->read == 0) {
                return $result = false;
            }
        }
    }

    public function searchUser($inputSearch)
    {
        log::info($inputSearch);
        $users = Db::table('users')
            ->select('nick')
            ->where('nick', 'LIKE', '%' . $inputSearch . '%')
            ->get();
    }
}
