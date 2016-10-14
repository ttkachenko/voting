<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Auth;

class VoteController extends Controller
{
    public function votesAllPeople(Request $request)
    {

        $this->voteToMan($request->all());

        $users = User::all();
        return view("vote.votesAllPeople", ['users' => $users]);
    }

    protected function voteToMan(array $data)
    {
        var_dump($data);
        if ($data['isVote'] == 1)
        {
            $historyVotes = $this->validator($data);


            DB::table('votes')->insert(
                [
                    'idTo' => $data['idTo'],
                    'vote' => $data['vote'],
                    'idFrom' => Auth::user()->id,
                ]
            );

            if ($data['vote'] == 1)
            {
                DB::table('users')->where('id', '=', $data['idTo'])->increment('countVotes' );
            }
            else
            {
                DB::table('users')->where('id', '=', $data['idTo'])->decrement('countVotes');
            }
        }
    }

    protected function getHistoryVotes(array $data)
    {
        $res = [
            "isVote" => 0,
            "vote" => 0
        ];
        $res["isVote"] = DB::table('votes')->where('idTo', '=', $data['idTo'])->where('idFrom', '=', Auth::user()->id)->where('vote', '=', $data['vote'])->count() == 0;
        if ($res["isVote"]===1)
            $res["vote"] =  DB::table('votes')->select('vote')->first();


        return $res;
    }



}
