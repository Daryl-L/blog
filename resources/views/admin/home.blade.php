<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <title>Laravel</title>
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>
    </body>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</html>
