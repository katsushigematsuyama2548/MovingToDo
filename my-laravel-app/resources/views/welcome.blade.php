<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body>
        <h1 class="text-3xl font-bold text-red-500 underline">Hello World</h1>
            <div class="bg-gray-100 line-through">
                <p class="text-3xl font-bold text-red-500 line-through">Hello World</p>
            </div>  
    </body>
</html>