<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Message;
use App\Models\User;
use App\Models\Image;
use App\Helpers\FormatTime;

class MessageController extends Controller
{
    public function showAll($nick)
    {
        $id = auth()->id();
        $messages = Db::select("SELECT * FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY sender + receiver ORDER BY created_at DESC) AS total FROM messages) t WHERE t.total = 1 AND (t.sender = $id OR t.receiver = $id)");

        return view('messages.showAll', compact('nick', 'messages'));
    }

    public function show($nick, $receiver)
    {
        $id = auth()->id();
        $total = $id + $receiver;

        $receiverUser = User::find($receiver);
        $receiverNick = $receiverUser->nick;
        $receiverAvatar = $receiverUser->image;

        $messages = Db::select("SELECT * FROM (SELECT *, sender + receiver AS total FROM messages) t WHERE t.total = $total");

        foreach ($messages as $index) {
            $update = Db::table('messages')
                ->where('id', $index->id)
                ->where('receiver', $id)
                ->update(['read' => 1]);
        }

        return view('messages.show', compact('nick', 'messages', 'receiver', 'receiverNick', 'receiverAvatar'));
    }

    public function readedState($nick, $sender, $messageId)
    {
        Db::table('messages')
            ->where('id', $messageId)
            ->update(['read' => 1]);
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
        if (!$request->filled('content')) {
            return response()->json([
                'message' => 'Mensaje no enviado!'
            ], 422);
        }

        $user = auth()->user();

        $message = new Message();
        $message->sender = $user->id;
        $message->receiver = $request->receiver;
        $message->read = false;
        $message->content = $request->content;
        $message->save();

        NewChatMessage::dispatch($message->sender, $message->receiver, $message->content, $user->image, $message->id);
        NewMessage::dispatch($message->receiver);

        return back();
    }

    public function searchForm($nick, $imageId)
    {
        return view('messages.searchForm', compact('nick', 'imageId'));
    }

    public function searchForLinks($nick, $inputSearch)
    {
        $id = auth()->id();

        $users = Db::table('users')
            ->select('users.id', 'users.nick')
            ->join('followers', 'users.id', '=', 'followers.following')
            ->where('followers.follower', '=', $id)
            ->where('users.nick', 'LIKE', '%' . $inputSearch . '%')
            ->get();

        return $users;
    }

    public function sendLinks($nick, $receiverId, $imageId)
    {
        $image = Image::find($imageId);
        $userId = $image->user->id;
        $avatar = '/profiles/' . $userId . '/' . $image->user->image;

        if ($image->user->name != null) {
            $name = $image->name;
        } else {
            $name = "";
        }
        if ($image->filename != null) {
            $fileName = $image->filename;
        }

        $message = new Message();
        $message->sender = auth()->id();
        $message->receiver = $receiverId;
        $message->read = false;
        $message->content = "<div class='link'><div class='top'><div class=''><img src='" . env('APP_URL') . $avatar . "'></div><h4>" . $nick . "</h4></div><div class='middle'><img src='" . env('APP_URL') . "/images/" . $userId . "/" . $fileName . "'></div><div class='bottom'><div class=''><h4>" . $nick . "</h4></div><div class=''><p>" . $name . "</p></div></div></div>";
        $pass = $message->save();

        return $pass;
    }
}
