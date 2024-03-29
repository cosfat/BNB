<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="manifest" href="/manifest.json">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
          crossorigin="anonymous">
    <style>
        .btn-danger {
            background-color: #dc3545 !important;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 mb-6">
    <!-- include('layouts.navigation') -->

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
<style>
    #button-container {
        position: fixed;
        bottom: 0;
        display: flex;
        width: 100%;
        justify-content: space-between;
        background: rgba(255, 255, 255, 0.9);
        padding: 10px;
        -webkit-box-shadow: 0px -1px 13px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px -1px 13px 0px rgba(0, 0, 0, 0.75);
        box-shadow: 0px -1px 13px 0px rgba(0, 0, 0, 0.75);
    }

    .svgclass {
        height: 40px;
    }
</style>
<div id="button-container">
    <a href="/dashboard"><img class="svgclass" src="/svg/sum.svg"></a>
    <a href="/expenses"><img class="svgclass" src="/svg/expense.svg"></a>
    <a href="/reservations"><img class="svgclass" src="/svg/res.svg"></a>
    <a href="/designers"><img class="svgclass" src="/svg/des.svg"></a>
    <a href="/profile"><img class="svgclass" src="/svg/profile.svg"></a>
</div>
</body>
</html>
