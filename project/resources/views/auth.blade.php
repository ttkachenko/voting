<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">

    <style>
        .auth label{
            text-align: right;
            font-weight: 500;
            vertical-align: bottom;
        }


    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="col-md-12">
            <a class="pull-left" href="/">&larr; на главную</a>
            <a class="pull-right" href="#">Зарегистрироваться</a>
        </div>
            <form class="auth col-md-12">

                <div class="col-md-12 form-group">
                    <div class="col-md-5"></div>
                    <div class="col-md-7"><h3 class="title">Вход</h3></div>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-md-5">Логин</label>
                    <div class="col-md-7"><input type="text" name="login"></div>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-md-5">Пaроль</label>
                    <div class="col-md-7"><input type="password" name="pass"></div>
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

    </div>
</div>
</body>
</html>
