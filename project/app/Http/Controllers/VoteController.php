<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Interfaces\VoteInterface as VoteInterface;

class VoteController extends Controller
{

    public function __construct(VoteInterface $voteRepo)
    {
        $this->voteRepo = $voteRepo;
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
        return  $this->voteRepo->getUserVote($data['idTo']);
    }

    public function getHistoryVotes(Request $request)
    {
        $data = $request->all();
        $historyVotes = $this->voteRepo->getHistoryVotesByUserIdTo($data['idTo']);
        return view('vote.historyVotes', ['historyVotes' => $historyVotes]);
    }


}
