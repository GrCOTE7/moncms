<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ (isset($title) ? $title . ' | ' : (View::hasSection('title') ? View::getSection('title') . ' | ' : '')) . config('app.name') }}
    </title>

    {{-- <title>@yield('title', config('app.name'))</title> --}}
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <link rel="stylesheet" href="{{ asset('storage/css/prism.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200 my-3">

    <x-main full-width>

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>

    </x-main>

    <x-toast />

    <script src="{{ asset('storage/scripts/prism.js') }}"></script>
</body>

</html>
