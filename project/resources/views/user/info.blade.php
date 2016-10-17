@extends('layout')

@section('content')

    <div class="col-md-12">
        <a class="pull-left" href="/">&larr; на главную</a>
        @if(!Auth::check())
            <ul class="list-menu pull-right">
                <li><a href="/auth/login">Вoйти</a></li>
                <li><a href="/auth/register">Зарегистрироваться</a></li>
            </ul>
        @endif

    </div>
    <div class="col-md-12 user-info">
        <div class="col-md-2">
            <img src="#">
        </div>
        <div class="col-md-10">
            <h3>{{ $user->login }}</h3>
            @if(!Auth::check())
                <a href="#">Изменить информацию о себе</a>
            @endif

            <p>Карма: {{ $user->countVotes }}</p>
            @if(Auth::check())
                @if (Auth::user()->id !== $user->id)
                    <a class="btn voteActionPlus voteAction <?php if ($user->vote==1)  echo 'btn-success'; else echo 'btn-default'; ?>"
                       href="#" data-to="{{ $user->id }}" data-vote="1">+</a>

                    <a class="btn voteActionMinus voteAction <?php if ($user->vote==-1)  echo 'btn-danger'; else echo 'btn-default'; ?>" href="#" data-to="{{ $user->id }}" data-vote="0">-</a>

                @endif
            @else

                <a class="btn btn-default" href="/auth/login">+</a>
                <a class="btn btn-default" href="/auth/login">-</a>

            @endif
        </div>
    </div>
    <div class="col-md-12 history-votes-area">
        <h3>История</h3>
        <div class="col-md-12 text-center hide" id="historyVotesLoader">
            <img src="loader.gif">
        </div>
        <div id="historyVotes">
        </div>
    </div>
    <div class="col-md-12 comments-area">
        <h3>Комментарии</h3>
    </div>



    <script>
        $(document).ready(function () {
            getHistoryVotes({{$user->id}});
        });

        $(document).on('click' ,".voteAction",function() {
            var idTo = $(this).data('to');
            var vote = $(this).data('vote');
            voteToMan(idTo, vote)
        });

        function voteToMan(idTo, vote)
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                data : {
                    idTo: idTo,
                    vote: vote
                },
                url : "/voteToMan",
                success : function(data){
                    $('.voteAction').removeClass('btn-success');
                    $('.voteAction').removeClass('btn-danger');
                    if (data==1)
                        $('.voteActionPlus').addClass('btn-success');
                    if (data==-1)
                        $('.voteActionMinus').addClass('btn-danger');
                    else $('.voteAction').addClass('btn-default');
                    getHistoryVotes(idTo);
                },
            });
        }

        function getHistoryVotes(idTo)
        {
            console.log(idTo);
            $('#historyVotes').html('');
            $('#historyVotesLoader').removeClass('hide');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                data : {
                    idTo: idTo
                },
                url : "/getHistoryVotes",
                success : function(data){
                    $('#historyVotesLoader').addClass('hide');
                    $('#historyVotes').html(data);
                },
                error : function(data){
                    console.log(data)
                },
            });
        }

    </script>
@endsection