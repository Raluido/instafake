<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikeComment;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CommentController extends Controller
{
    public function liked($nick, $dataId)
    {
        $id = auth()->id();

        $check = Db::select("SELECT * FROM likes_comments WHERE likes_comments.giver = $id AND likes_comments.comment_id = $dataId;");

        if (empty($check[0])) {
            $likeComment = new LikeComment();
            $likeComment->comment_id = $dataId;
            $likeComment->giver = $id;
            $likeComment->save();

            $likesAmount = Db::table('likes_comments')
                ->where('comment_id', $dataId)
                ->count();

            $result = [
                true,
                $likesAmount,
            ];

            return $result;
        } else {
            $check = Db::table('likes_comments')
                ->where('giver', $id)
                ->where('comment_id', $dataId)
                ->delete();

            $likesAmount = Db::table('likes_comments')
                ->where('comment_id', $dataId)
                ->count();

            $result = [
                false,
                $likesAmount,
            ];

            return $result;
        }
    }

    public function showAll($nick, $imageId)
    {
        $id = auth()->id();

        $images = Image::where('id', $imageId)
            ->get();

        return view('comments.showAll', compact('nick', 'id', 'images'));
    }

    public function store($nick, Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|max:255',
        ]);

        $comment = Comment::create(
            [
                'image_id' => $request['imageId'],
                'commentator' => auth()->id(),
                'content' => $validated['content'],
            ]
        );

        return redirect()->back()->withErrors(__('Ha habido un error al enviar el comentario, disculpe las molestias.'));
    }
}
