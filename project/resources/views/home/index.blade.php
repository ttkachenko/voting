@extends('layout')

@section('content')


    <div class="col-md-8">
        <h2 class="title">Лучшие люди Интернета</h2>
        <div id="votesAllPeople">



        </div>
    </div>
    <div class="col-md-4">
        @if(Auth::check())
            <div><a href="auth/logout">Выйти</a></div>
        @else

            <ul class="menu">
                <li><a href="auth/login">Вoйти</a></li>
                <li><a href="auth/register">Зарегистрироваться</a></li>
            </ul>
        @endif

    </div>

    <script>
        $(document).ready(function () {
            loadPeople(0);
        });


        $(document).on('click' ,".voteAction",function() {
            var to = $(this).data('to');
            var vote = $(this).data('vote');
            console.log(to);
            console.log(vote);
            loadPeople(1, to, vote);
        });

        function loadPeople(isVote, idTo, vote)
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                data : {
                    isVote: isVote,
                    idTo: idTo,
                    vote: vote
                },
                url : "/votesAllPeople",
                success : function(data){
                    $('#votesAllPeople').html(data);
                }
            });
        }


      /*  function voteToMan(isVote, idFrom, vote)
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                url : "/voteToMan",
                data : {
                    isVote: isVote,
                    idFrom: idFrom,
                    vote: vote
                },
                success : function(data){
                    $('#votesAllPeople').html(data);
                }
            });
        }*/
    </script>


@endsection