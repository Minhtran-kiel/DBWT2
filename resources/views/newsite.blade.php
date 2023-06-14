<!DOCTYPE html>
<html>

<head>
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <title>newsite</title>
    {{--<script defer src="{{ asset('js/warenkorb.js') }}"></script>--}}
    @vite(['resources/js/app.js'])
</head>

<body id="app">
    
    <app></app>

</body>
</html>