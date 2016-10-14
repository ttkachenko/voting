@extends('layout')

@section('content')


    <div class="col-md-8">
        <h2 class="title">Лучшие люди Интернета</h2>
        <div class="people">
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
                        <a href="#">+</a>
                        <div class="clearfix"></div>
                        <a href="#">-</a>
                    </div>
                    <div class="clearfix"></div>

                </div>
            @endforeach

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


@endsection