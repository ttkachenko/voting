<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Interfaces\CommentInterface as CommentInterface;

class CommentController extends Controller
{
    public function __construct(CommentInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

   public function getComments(Request $request)
   {
       $data = $request->all();
       $comments = $this->commentRepo->getComments($data['idTo']);
       return view('comment.commentsList', ['comments' => $comments]);
   }

    public function addComment(Request $request)
    {
        $data = $request->all();
        $commentId=$this->commentRepo->addComment($data['idTo'], $data['comment']);
        $comment=$this->commentRepo->getCommentById($commentId);
        return view('comment.commentBlock', ['comment' => $comment]);
    }
}
