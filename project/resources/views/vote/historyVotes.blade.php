@foreach($historyVotes as $historyVote)
    <div class="history-vote <?php if ($historyVote->vote==1)  echo 'history-vote-success'; else echo 'history-vote-danger'; ?>">
        {{$historyVote->dateVote}}
        <a href="/info/{{$historyVote->idFrom}}">{{$historyVote->login}}</a>
        поставил<?php if (!$historyVote->isMan)  echo 'а'; else echo ''; ?>
        @if($historyVote->vote==1) +
        @else -
        @endif
    </div>

@endforeach