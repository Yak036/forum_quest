<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name'))</title>

        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
        
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <style>
        /* Custom scrollbar styles */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: #1f2937;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #4b5563;
            border-radius: 6px;
            border: 3px solid #1f2937;
        }
        </style>
        <div class="min-h-screen bg-gray-300">
            @if (Route::currentRouteName() != 'register')
                @include('layouts.navigation')
            @endif

            <!-- Page Content -->
            <main class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
        </div>

        @livewireScripts
    </body>
</html>
