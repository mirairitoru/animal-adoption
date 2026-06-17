<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-noto antialiased h-screen">
        @if(session('success'))
            {{ session('success') }}
        @endif
        @if(session('error'))
            {{ session('error') }}
        @endif
        @include('layouts.header')
        <main class="min-h-screen max-w-7xl mx-auto">
            {{ $slot }}
        </main>
        @include('layouts.foter')
    </body>
</html>
