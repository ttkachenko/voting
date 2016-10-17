@extends('layout')

@section('content')

<div class="col-md-12">
    <a class="pull-left" href="/">&larr; на главную</a>
    <div class="cur-user-block col-md-3 pull-right">
        <p>Привет, <a href="/info/<?= Auth::user()->id ?>"><?= Auth::user()->login ?></a></p>
        <div class="user-image">
            <img src="<?= Auth::user()->imagePath ?>">
            <div class="clearfix"></div>
            <a href="auth/logout">Выйти</a>
        </div>
        <div class="user-rating">
            <?= Auth::user()->countVotes ?>
        </div>

    </div>

</div>
<div class="col-md-12">
    <form class="auth col-md-12" method="POST" action="#">
        {!! csrf_field() !!}

        <div class="col-md-12 form-group">
            <div class="col-md-5"></div>
            <div class="col-md-7"><h3 class="title">Moй профиль</h3></div>
        </div>
        @if ($errors->has())
            <div class="col-md-12 form-group">
                <div class="col-md-5"></div>
                <div class="col-md-7">
                    @foreach($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="col-md-12 form-group">
            <label class="col-md-5">Логин</label>
            <div class="col-md-7">выф</div>
        </div>


        <div class="col-md-12 form-group">
            <div class="col-md-5"></div>
            <div class="col-md-7"><button type="submit">Войти</button></div>
        </div>
    </form>
</div>

@endsection