<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <meta name="_token" content="<?php echo csrf_token(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">

    <link href="/styles/main.css" type="text/css" rel="stylesheet">

    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

</head>
<body>
<div class="container">
    <div class="content">

        @yield('content')


    </div>
</div>


</body>
</html>
