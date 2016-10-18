<?php
$months = array (
        1 => 'января',
        2 => 'февраля',
        3 => 'марта',
        4 => 'апреля',
        5 => 'мая',
        6 => 'июня',
        7 => 'июля',
        8 => 'августа',
        9 => 'сентября',
        10 => 'октября',
        11 => 'ноября',
        12 => 'декабря');
?>
@foreach($historyVotes as $historyVote)
    <div class="history-vote <?php if ($historyVote->vote==1)  echo 'history-vote-success'; else echo 'history-vote-danger'; ?>">

        <?php
            $month = (int)date("m", strtotime($historyVote->dateVote));
            echo date("j $months[$month] Y", strtotime($historyVote->dateVote));
        ?>
        <a href="/info/{{$historyVote->idFrom}}">{{$historyVote->login}}</a>
        поставил<?php if (!$historyVote->isMan)  echo 'а'; else echo ''; ?>
        @if($historyVote->vote==1) +
        @else -
        @endif
    </div>

@endforeach