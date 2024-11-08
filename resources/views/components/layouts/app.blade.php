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

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- HERO --}}
    <div class="min-h-[10vw] hero" style="background-image: url({{ asset('storage/hero.jpg') }});">
        <div class="bg-opacity-60 hero-overlay"></div>
        <a href="{{ '/' }}">
            <div class="text-center hero-content text-neutral-content">
                <div>
                    <h1 class="mb-5 text-4xl font-bold sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl">
                        Mon Titre
                    </h1>
                    <p class="mb-1 text-lg sm:text-xl md:text-1xl lg:text-2xl xl:text-3xl">
                        Mon sous-titre
                    </p>
                </div>
            </div>
        </a>
    </div>

    {{-- NAVBAR --}}
    <livewire:navigation.navbar :$menus />

    <x-main full-width>

        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit lg:hidden">
            <livewire:navigation.sidebar :$menus />
        </x-slot:sidebar>

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>

    </x-main>

    <hr><br>
    <livewire:navigation.footer />
    <br>

    <x-toast />

    <script src="{{ asset('storage/scripts/prism.js') }}"></script>
</body>

</html>
