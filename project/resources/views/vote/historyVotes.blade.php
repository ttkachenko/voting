@foreach($historyVotes as $historyVote)
    <div class="historyVote">
        {{$historyVote->dateVote}}
        <a href="/info/{{$historyVote->idFrom}}">{{$historyVote->login}}</a>
        поставил
        @if($historyVote->vote==1) +
        @else -
        @endif
    </div>

@endforeach