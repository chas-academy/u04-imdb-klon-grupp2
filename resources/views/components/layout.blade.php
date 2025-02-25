<!DOCTYPE html>
<html lang="en" class="font-primary bg-slate-800 text-slate-50 antialiased">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="{{ asset('favicon.svg') }}" />
        <title>{{ isset($title) ? "$title | Popco" : 'Popco' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex min-h-screen flex-col items-center">
        <x-header />
        <main
            {{ $attributes->twMerge(['class' => 'mt-header-mobile sm:mt-header-desktop mb-16 w-full max-w-5xl flex-1 px-4 md:mb-20']) }}
        >
            {{ $slot }}
        </main>
        <x-footer />
    </body>
</html>
