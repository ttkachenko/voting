<?php
namespace App\Http\Interfaces;


interface CommentInterface
{
    public function getComments($userId);

    public function addComment($userIdTo, $comment);

    public function getCommentById($commentId);
}
