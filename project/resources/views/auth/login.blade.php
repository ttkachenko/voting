@extends('layout')

@section('content')

<div class="col-md-12">
    <a class="pull-left" href="/">&larr; на главную</a>
    <a class="pull-right" href="/auth/register">Зарегистрироваться</a>
</div>
<form class="auth col-md-12" method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div class="col-md-12 form-group">
        <div class="col-md-5"></div>
        <div class="col-md-7"><h3 class="title">Вход</h3></div>
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
        <div class="col-md-7"><input type="text" name="login"></div>
    </div>
    <div class="col-md-12 form-group">
        <label class="col-md-5">Пароль</label>
        <div class="col-md-7"><input type="password" name="password"></div>
    </div>
    <div class="col-md-12 form-group">
        <label class="col-md-5">Текст с картинки</label>
        <div class="col-md-7"><input type="text" name="text"></div>
    </div>
    <div class="col-md-12 form-group">
        <div class="col-md-5"></div>
        <div class="col-md-7"><button type="submit">Войти</button></div>
    </div>
</form>

@endsection