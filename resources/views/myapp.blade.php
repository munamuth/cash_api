<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
    @if (Auth::check())
        <script>window.authUser={!! json_encode(Auth::user()); !!};</script>
    @else
        <script>window.authUser=null;</script>
    @endif
    <div id="app">        
        <master></master>
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>