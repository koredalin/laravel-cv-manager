<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CV Мениджър')</title>

    <!--<title>{{ config('app.name', 'CV Мениджър') }}</title>-->

    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/css/style.css',
        'resources/js/app.js',])
</head>
<body>

    <div class="container">
    @section('content')
        This is the master sidebar.
    @show
    </div>
    
</body>
</html>