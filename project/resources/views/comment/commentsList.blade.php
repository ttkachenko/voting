@foreach($comments as $comment)
    <div class="comment">
        {{$comment->comment}}
        <p>Написал<?php if (!$comment->isMan)  echo 'а'; else echo ''; ?> <a href="/info/{{$comment->idFrom}}">{{$comment->login}}</a> {{$comment->dateComment}}</p>
    </div>

@endforeach

