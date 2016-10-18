@extends('layout')

@section('content')

    <div class="col-md-12">
        <a class="pull-left" href="/">&larr; на главную</a>
        <a class="pull-right" href="/auth/login">Войти</a>
    </div>
    <form class="auth col-md-8" method="POST" action="/auth/register" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="col-md-12 form-group">
            <div class="col-md-5"></div>
            <div class="col-md-7"><h3 class="title">Регистрация</h3></div>
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
            <label class="col-md-5" for="login">Логин</label>
            <div class="col-md-7"><input type="text" name="login" id="login"></div>
        </div>
        <div class="col-md-12 form-group">
            <label class="col-md-5" for="password">Пaроль</label>
            <div class="col-md-7">
                <input type="password" name="password" id="password">
                <input type="checkbox" id="show-pass"> показать пароль
            </div>
        </div>

        <div class="col-md-12 form-group">
            <label class="col-md-5" for="isMan">Пол</label>
            <div class="col-md-7">
                <select name="isMan" id="isMan">
                    <option value="1">Мужской</option>
                    <option value="0">Женский</option>
                </select>
            </div>
        </div>

        <div class="col-md-12 form-group">
            <label class="col-md-5" for="image">Aватар</label>
            <div class="col-md-7"><input type="file" name="image" id="image"></div>
        </div>

        <div class="col-md-12 form-group">
            <div class="col-md-5"></div>
            <div class="col-md-7"><button type="submit">Зарегистрироваться</button></div>
        </div>
    </form>


    <script>

        $(document).on('change' ,"#show-pass",function() {
            if($(this).is(':checked'))
                $('#password').attr('type', 'text');

            else $('#password').attr('type', 'password');

        });
    </script>
@endsection