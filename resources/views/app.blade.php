<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#ff9800">
        <link rel="icon" sizes="192x192" href="{{ asset('img/logo_icon_for_tab.png') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
    </head>
    <body>
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
