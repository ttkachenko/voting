@extends('layout')

@section('content')

<div class="col-md-12">
    <a class="pull-left" href="/">&larr; на главную</a>
    <div class="cur-user-block col-md-3 pull-right">
        <p>Привет, <a href="/info/<?= Auth::user()->id ?>"><?= Auth::user()->login ?></a></p>
        <div class="user-image">
            <img src="<?php if (Auth::user()->imagePath==='')  echo '/user.png'; else echo "/avatars/".Auth::user()->imagePath; ?>">
            <div class="clearfix"></div>
            <a href="auth/logout">Выйти</a>
        </div>
        <div class="user-rating">
            <?= Auth::user()->countVotes ?>
        </div>

    </div>

</div>
<div class="clearfix"></div>
<div class="col-md-12">
    <form class="auth col-md-8" method="POST" action="/edit" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="col-md-12 form-group">
            <div class="col-md-5"></div>
            <div class="col-md-7"><h3 class="title">Moй профиль</h3></div>
        </div>
        @if ($errors->has())
            <div class="col-md-12 form-group">
                <div class="col-md-5"></div>
                <div class="col-md-7 error-block">
                    <img src="/warning.png">
                    <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="col-md-12 form-group">
            <label class="col-md-5">Мой логин</label>
            <div class="col-md-7">{{ Auth::user()->login }}</div>
        </div>
        <div class="col-md-12 form-group">
            <label class="col-md-5" for="image">Аватар</label>
            <div class="col-md-7"><input type="file" name="image" id="image"></div>
        </div>
        <div class="col-md-12 form-group">
            <label class="col-md-5" for="isMan">Пол</label>
            <div class="col-md-7">
                <select name="isMan" id="isMan">
                    <option value="1">Мужской</option>
                    <option value="0" <?php if (!Auth::user()->isMan)  echo "selected='selected'"; else echo ''; ?>>Женский</option>
                </select>
            </div>
        </div>

        <div class="col-md-12 form-group">
            <div class="col-md-5"></div>
            <div class="col-md-7"><button type="submit">Сохранить</button></div>
        </div>
    </form>
</div>

@endsection