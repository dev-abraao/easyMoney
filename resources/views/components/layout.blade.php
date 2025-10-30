<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">

        <title>{{  $title ?? config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/sidebar.css'])

        <script>
        (function() {
            const savedState = localStorage.getItem('sidebarState');
            if (savedState === 'compact') {
                document.documentElement.classList.add('sidebar-compact');
            }
        })();
        </script>
    </head>
    <body class="bg-gray-900 text-white font-lato">
        <div class="flex min-h-screen">
            <div id="sidebar-container" class="flex-shrink-0 transition-all duration-300">
                <x-sidebar/>
            </div>
            <div id="main-content" class="flex-1 overflow-auto">
                {{ $slot }}
            </div>
        </div>
        @stack('scripts')
    </body>
</html>