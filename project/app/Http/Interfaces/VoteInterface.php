<?php
namespace App\Http\Interfaces;

interface VoteInterface
{
    public function votesAllPeople(array $data);

    public function getUserVote($userIdTo);

    public function getHistoryVotesByUserIdTo($userIdTo);

    public function voteToMan($idTo, $vote);

}
