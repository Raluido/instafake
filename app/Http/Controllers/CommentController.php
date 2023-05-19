<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikeComment;
use Illuminate\Support\Facades\DB;


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
}
