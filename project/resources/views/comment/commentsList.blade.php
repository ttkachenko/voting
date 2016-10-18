<?php $months = array (
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
@foreach($comments as $comment)
    <div class="comment">
        {{$comment->comment}}
        <p>Написал<?php if (!$comment->isMan)  echo 'а'; else echo ''; ?> <a href="/info/{{$comment->idFrom}}">{{$comment->login}}</a>
            <?php
                $month = (int)date("m", strtotime($comment->dateComment));
                echo date("j $months[$month] Y", strtotime($comment->dateComment));
            ?>
        </p>
    </div>

@endforeach

