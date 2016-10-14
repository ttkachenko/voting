@extends('layout')

@section('content')

    <div class="col-md-12">
        <a class="pull-left" href="/">&larr; на главную</a>
        <a class="pull-right" href="/auth/login">Войти</a>
    </div>
    <form class="auth col-md-12" method="POST" action="/auth/register">
        {!! csrf_field() !!}

        <div class="col-md-12 form-group">
            <div class="col-md-5"></div>
            <div class="col-md-7"><h3 class="title">Регистрация</h3></div>
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
            <label class="col-md-5">Пaроль</label>
            <div class="col-md-7"><input type="password" name="password"></div>
        </div>

        <div class="col-md-12 form-group">
            <label class="col-md-5">Пол</label>
            <div class="col-md-7">
                <select name="isMan">
                    <option value="1">Мужской</option>
                    <option value="0">Женский</option>
                </select>
            </div>
        </div>

        <div class="col-md-12 form-group">
            <label class="col-md-5">Imagre</label>
            <div class="col-md-7"><input type="text" name="imagePath"></div>
        </div>

        <div class="col-md-12 form-group">
            <div class="col-md-5"></div>
            <div class="col-md-7"><button type="submit">Зарегистрироваться</button></div>
        </div>
    </form>

@endsection