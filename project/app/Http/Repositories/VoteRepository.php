<?php
namespace App\Http\Repositories;
use App\Http\Interfaces\VoteInterface as VoteInterface;
use DB;
use App\User;
use Auth;
use Faker\Provider\DateTime;


class VoteRepository implements VoteInterface
{
    public function getUserVote($userIdTo)
    {
        if (DB::table('votes')->where('idTo', '=', $userIdTo)->where('idFrom', '=', Auth::user()->id)->count() ==0 )
            return 0;
        if (DB::table('votes')->where('idTo', '=', $userIdTo)->where('idFrom', '=', Auth::user()->id)->where('vote', '=', 1)->count() ==1 )
            return 1;
        else return -1;
    }

    public function getHistoryVotesByUserIdTo($userIdTo)
    {
        return  DB::table('votes')
            ->join('users', 'votes.idFrom', '=', 'users.id')
            ->where('votes.idTo', '=', $userIdTo)
            ->select('users.login', 'votes.vote', 'votes.idFrom', 'votes.dateVote')
            ->orderBy('votes.dateVote', 'desc')
            ->get();
    }



    public function votesAllPeople(array $data)
    {
        if ($data['isVote'] == 1) {
            $this->voteToMan($data['idTo'], $data['vote']);
        }
        $users = Auth::check()
            ? User::select('id', 'login', 'countVotes', 'imagePath')->where('id', '!=', Auth::user()->id) ->orderBy('countVotes', 'desc')->get()
            : User::select('id', 'login', 'countVotes', 'imagePath')->orderBy('countVotes', 'desc')->get();
        if (Auth::check())
        {
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
        }
        return $users;
    }

    public function voteToMan($idTo, $vote)
    {
            $historyVotes = $this->getHistoryVotes($idTo, $vote);
            if ($historyVotes==-1)
                return;
            if ($historyVotes==0)
            {
                DB::table('votes')->insert(
                    [
                        'idTo' => $idTo,
                        'vote' => $vote,
                        'idFrom' => Auth::user()->id,
                        'dateVote' => date( "Y-m-d H:i" )
                    ]
                );
            }
            else if($historyVotes==1) {
                DB::table('votes')
                    ->where('idTo', '=', $idTo)
                    ->where('idFrom', '=', Auth::user()->id)
                    ->update(['vote' => $vote, 'dateVote' => date( "Y-m-d H:i" )]);
            }
            else
            {
                DB::table('votes')
                    ->where('idTo', '=', $idTo)
                    ->where('idFrom', '=', Auth::user()->id)
                    ->delete();
            }

            if ($vote == 1)
            {
                DB::table('users')->where('id', '=', $idTo)->increment('countVotes', 1 + $historyVotes);
            }
            else
            {
                DB::table('users')->where('id', '=', $idTo)->decrement('countVotes', 1 + $historyVotes);
            }

    }

    private function getHistoryVotes($idTo, $vote)
    {
        if ($idTo == Auth::user()->id)
            return -1;
        if (DB::table('votes')->where('idTo', '=', $idTo)->where('idFrom', '=', Auth::user()->id)->count() ==0 )
            return 0;
        if (DB::table('votes')->where('idTo', '=', $idTo)->where('idFrom', '=', Auth::user()->id)->where('vote', '=', $vote)->count() == 0 )
            return 1;
        else return -2;

    }

}