<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang(config('app.name', 'Task Manager'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css'])
</head>

<body class="font-sans antialiased">
    {{-- @include('flash::message') --}}

    <div id="app">

        <header class="fixed w-full">
            @include('layouts.navigation1')
            @include('flash::message')
        </header>

        <!-- Page Content -->
        <main class="bg-white dark:bg-gray-900">
            {{ $slot }}
        </main>
    </div>

    @vite(['resources/js/app.js'])
</body>

</html>