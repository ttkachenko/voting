@foreach($users as $user)
    <div class="man">
        <div class="col-md-3">
            <img src="<?php if ($user->imagePath==='')  echo '/user.png'; else echo "/avatars/".$user->imagePath; ?>">
            <div class="clearfix"></div>
            <div class="login text-center">
                <a href="/info/{{$user->id}}">{{$user->login }}</a>
            </div>

        </div>
        <div class="col-md-7 text-center carma">
            {{$user->countVotes }}
        </div>
        <div class="col-md-2 text-right">
            @if(Auth::check())

                <a class="btn voteButton  voteAction <?php if ($user->vote==1)  echo 'btn-success'; else echo 'btn-default'; ?>"
                   href="#" data-to="{{ $user->id }}" data-vote="1">+</a>
                <div class="clearfix"></div>
                <a class="btn voteButton  voteAction <?php if ($user->vote==-1)  echo 'btn-danger'; else echo 'btn-default'; ?>" href="#" data-to="{{ $user->id }}" data-vote="0">-</a>

            @else

                <a class="btn btn-default voteButton" href="/auth/login">+</a>
                <div class="clearfix"></div>
                <a class="btn btn-default voteButton" href="/auth/login">-</a>
            @endif

        </div>
        <div class="clearfix"></div>
    </div>
@endforeach