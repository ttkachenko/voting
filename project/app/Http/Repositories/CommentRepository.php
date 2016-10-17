<?php
namespace App\Http\Repositories;
use App\Comment;
use App\Http\Interfaces\CommentInterface as CommentInterface;
use DB;
use App\User;
use Auth;


class CommentRepository implements CommentInterface
{
    public function getComments($userId)
    {
        return  DB::table('comments')
            ->join('users', 'comments.idFrom', '=', 'users.id')
            ->where('comments.idTo', '=', $userId)
            ->select('users.login', 'comments.comment', 'comments.dateComment', 'comments.idFrom', 'users.isMan')
            ->orderBy('comments.dateComment', 'desc')
            ->get();
    }

    public function addComment($userIdTo, $commentText)
    {
       /*return DB::table('comments')->insert(
            [
                'idTo' => $userIdTo,
                'comment' => $comment,
                'idFrom' => Auth::user()->id,
                'dateComment' => date( "Y-m-d H:i" )
            ]
        );*/
        $comment = new Comment;

        $comment->idTo = (int)$userIdTo;
        $comment->comment = $commentText;
        $comment->idFrom = Auth::user()->id;
        $comment->dateComment = date( "Y-m-d H:i" );

        $comment->save();

        return $comment->id;
    }

    public function getCommentById($commentId)
    {
       return  DB::table('comments')
            ->join('users', 'comments.idFrom', '=', 'users.id')
            ->where('comments.id', '=', $commentId)
           ->select('users.login', 'comments.comment', 'comments.dateComment', 'comments.idFrom', 'users.isMan')
            ->first();
    }


}