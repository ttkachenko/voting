<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Auth;
use App\Vote;

class VoteController extends Controller
{
    public function votesAllPeople(Request $request)
    {

        $this->voteToMan($request->all());

        $users = User::select('id', 'login', 'countVotes', 'imagePath')->where('id', '!=', Auth::user()->id) ->orderBy('countVotes', 'desc')->get();

        $curLikes= DB::table('votes')->select('idTo')->where('idFrom', '=', Auth::user()->id)->where('vote', '=', 1)->get();
        $curLikesArray = array();
        $curLikesData = collect($curLikes)->map(function($x){ return (array) $x; })->toArray();
        foreach ($curLikesData as $curLike)
        {
            $curLikesArray[] = $curLike['idTo'];
        }

        $curDislikes= DB::table('votes')->select('idTo')->where('idFrom', '=', Auth::user()->id)->where('vote', '=', 0)->get();
        $curDislikesData = collect($curDislikes)->map(function($x){ return (array) $x; })->toArray();
        $curDislikesArray =array();
        foreach ($curDislikesData as $curDislike)
        {
            $curDislikesArray[] = $curDislike['idTo'];
        }

        foreach ($users as $user)
        {

            $user['vote'] = in_array( strval($user['id']), $curLikesArray) ? 1 : (in_array(strval($user['id']), $curDislikesArray) ? -1 : 0 );

        }


        return view("vote.votesAllPeople", ['users' => $users]);
    }

    protected function voteToMan(array $data)
    {

        if ($data['isVote'] == 1)
        {
            $historyVotes = $this->getHistoryVotes($data);
            if ($historyVotes==-1)
                return;
            if ($historyVotes==0)
            {
                DB::table('votes')->insert(
                    [
                        'idTo' => $data['idTo'],
                        'vote' => $data['vote'],
                        'idFrom' => Auth::user()->id,
                    ]
                );
            }
            else {
                DB::table('votes')
                    ->where('idTo', '=', $data['idTo'])
                    ->where('idFrom', '=', Auth::user()->id)
                    ->update(['vote' => $data['vote']]);
            }



            if ($data['vote'] == 1)
            {
                DB::table('users')->where('id', '=', $data['idTo'])->increment('countVotes', 1 + $historyVotes);
            }
            else
            {
                DB::table('users')->where('id', '=', $data['idTo'])->decrement('countVotes', 1 + $historyVotes);
            }
        }
    }

    protected function getHistoryVotes(array $data)
    {
        if ($data['idTo'] == Auth::user()->id)
            return -1;
        if (DB::table('votes')->where('idTo', '=', $data['idTo'])->where('idFrom', '=', Auth::user()->id)->count() ==0 )
            return 0;
        if (DB::table('votes')->where('idTo', '=', $data['idTo'])->where('idFrom', '=', Auth::user()->id)->where('vote', '=', $data['vote'])->count() == 0 )
            return 1;
        else return -1;

    }
}
