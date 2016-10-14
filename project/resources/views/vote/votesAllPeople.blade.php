@foreach($users as $user)
    <div class="man">
        <div class="col-md-4">
            <img src="{{$user->imagePath }}">
            <div class="clearfix"></div>
            <a href="#">{{$user->login }}</a>
        </div>
        <div class="col-md-6 text-center">
            {{$user->countVotes }}
        </div>
        <div class="col-md-2">
            @if(Auth::check())

                <a class="btn btn-default voteAction" href="#" data-to="{{ $user->id }}" data-vote="1">+</a>
                <div class="clearfix"></div>
                <a class="btn btn-default voteAction" href="#" data-to="{{ $user->id }}" data-vote="0">-</a>

            @else

                <a class="btn btn-default" href="/auth/login">+</a>
                <div class="clearfix"></div>
                <a class="btn btn-default" href="/auth/login">-</a>
            @endif

        </div>
        <div class="clearfix"></div>
    </div>
@endforeach