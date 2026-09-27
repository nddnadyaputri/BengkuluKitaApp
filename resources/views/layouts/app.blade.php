<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'BengkuluKita') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-[#f7f0e4]">

        @include('layouts.navigation')

        @isset($header)

            <header class="bg-[#fffaf2] border-b border-[#e2d5c3]">

                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                    {{ $header }}

                </div>

            </header>

        @endisset


        <main>

            @yield('content')

        </main>

    </div>

</body>

</html>