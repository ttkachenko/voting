<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">

    <style>
        .menu{
            margin-top: 20px;
            list-style-type: none;
        }
        .man{
            border: #aaa 1px solid;
            padding: 10px;
            width: 100%;
            list-style-type: none;
            border-radius: 5px;
        }


    </style>




</head>
<body>
<div class="container">
    <div class="content">



        @yield('content')


    </div>
</div>
</body>
</html>
