<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <meta name="_token" content="<?php echo csrf_token(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    <style>
        .menu{
            margin-top: 20px;
            list-style-type: none;
        }
        .list-menu{
            list-style-type: none;
        }
        .man{
            border: #aaa 1px solid;
            padding: 10px;
            width: 100%;
            list-style-type: none;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .cur-user-block
        {
            border: #aaa 1px dashed;
            padding: 10px;
            margin-top: 20px;
            border-radius: 2px;
        }
        .user-image, .user-rating
        {
            width: 50%;
            float: left;
        }

        .user-info
        {
            border-bottom: #ccc 3px solid;
            padding-bottom: 15px;
        }

        .history-vote{
            padding: 10px;
            border-radius: 2px;
            margin-bottom: 10px;
        }

        .history-vote-success{
            background: #449d4480;
        }

        .history-vote-danger{
            background: #f0999699;
        }
        .cur-user-block img{
            width:40px;
        }

        .user-info img{
            margin-top:20px;
        }
        .user-menu-block .user-rating{
            font-size: 22px;
        }

        .auth
        {

            margin-left: 10%;
        }

        .auth label
        {
            text-align: right;
            font-weight: 500;
        }

        .auth .left-block, .auth .right-block{
            width: 50%;
            float: left;
            padding-left: 15px;

        }

        .error-block
        {
            background: #f0999699;
            padding: 15px 10px;
        }
        .error-block ul{
            margin: 5px 0 0 0;
            float:left;
        }
        .error-block li{
            list-style-type: none;
        }
        .error-block img{
            float:left;
        }



        @media (min-width:1200px) {
            .cur-user-block
            {
                float: right;

            }
        }

        @media (min-width:989px){
            .user-menu-block
            {
                float: right;
            }
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
