<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Interfaces\UserInterface as UserInterface;
use App\Http\Interfaces\VoteInterface as VoteInterface;

class VoteController extends Controller
{

    public function __construct(UserInterface $userRepo, VoteInterface $voteRepo)
    {
        $this->voteRepo = $voteRepo;
        $this->userRepo = $userRepo;
    }

    public function votesAllPeople(Request $request)
    {
        $users = $this->voteRepo->votesAllPeople($request->all());

        return view("vote.votesAllPeople", ['users' => $users]);
    }

    public function voteToMan(Request $request)
    {
        $data = $request->all();
        $this->voteRepo->voteToMan($data['idTo'], $data['vote']);
        $res=[
            "curVote" => $this->voteRepo->getUserVote($data['idTo']),
            "countVotes" => $this->userRepo->getUserById($data['idTo'])->countVotes
        ];
        return  $res;
    }

    public function getHistoryVotes(Request $request)
    {
        $data = $request->all();
        $historyVotes = $this->voteRepo->getHistoryVotesByUserIdTo($data['idTo']);
        return view('vote.historyVotes', ['historyVotes' => $historyVotes]);
    }


}
