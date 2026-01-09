<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BatasKota Coffee')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#0A5DAD",
                        "background-light": "#f8f7f6",
                        "background-dark": "#221a10",
                        hover: "#083672",
                    },
                    fontFamily: {
                        display: ["Work Sans", "sans-serif"],
                    },
                },
            },
        };
    </script>
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark text-[#1b160d] dark:text-white font-display">
    @include('layouts.partials.header')
    
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    @include('layouts.partials.footer')
    
    @stack('scripts')
</body>
</html>
