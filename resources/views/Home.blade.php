<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel 9 with vue 3 vite</title>
        @vite('resources/css/app.css')
    </head>
    <body class=" dark:bg-gray-700">
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>
</html>