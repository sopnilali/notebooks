<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900 antialiased">
        <div class="flex min-h-screen flex-col">
            <x-MainLayout.header />

            <main class="flex-1">
                {{ $slot }}
            </main>

            <x-MainLayout.footer />
        </div>
    </body>
</html>
