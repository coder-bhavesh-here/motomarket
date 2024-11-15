<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image" itemprop="image"
        content="https://photos.smugmug.com/Galleries/Motorcycles/i-LRCdKWq/0/LfMtVbcFp6X3xmcSNDwq6wbPcR6JS2Dn3GJvhTF7S/X2/cj.photos-_CJ07462-X2.jpg">
    <meta property="og:description"
        content="A plateform where you can find your buddies to ride with from the globe to any destination." />
    <meta property="og:title" content="World On Moto" />
    <meta property="og:site_name" content="World On Moto">
    <meta property="og:type" content="website" />

    <title>World On Moto</title>
    <link rel="icon" type="image/png" href="{{ asset('images/fav.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
