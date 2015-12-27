<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>itway.io</title>
    @include('includes.styles')
    <style>
        body {
            display: block!important;
            position: relative!important;
            width: 100%!important;
            height: 100%!important;
            margin: 0 auto!important;
        }
        .banned {
            display: block!important;
            width: 100%!important;
            height: 100%!important;
            background: #34495e!important;
            position: relative!important;
        }
    </style>
</head>
<body>

<div class="banned">
    <h1 class="text-info text-center">Good-bye, {{$username}}</h1>
    <h1 class="text-warning text-center">
        you are banned
    </h1>
    <p class="text-center text-white">
        have a nice day and <a href="https://www.google.com">leave</a>
    </p>
</div>
</body>
</html>