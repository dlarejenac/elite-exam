<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>
<body>
    @yield('exam-selection')
    @yield('php-question-1')
    @yield('php-question-2')
    @yield('php-question-3')
    @yield('login')
    @yield('dashboard')
    @yield('artists')
    @yield('albums')
</body>
</html>