<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ISS-LOOPS') }} - @yield('title', 'Divulgación Científica')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles
</head>
<body class="antialiased bg-gray-50">
    <!-- Header/Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <span class="text-2xl font-bold text-blue-600">ISS-LOOPS</span>
                    </a>
                </div>

                <!-- Main Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('Artículos') }}
                    </a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('Categorías') }}
                    </a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('Sobre Nosotros') }}
                    </a>
                </div>

                <!-- Right side - Language & Auth -->
                <div class="flex items-center space-x-4">
                    <!-- Language Switcher (placeholder) -->
                    <button class="text-gray-600 hover:text-blue-600">
                        {{ strtoupper(app()->getLocale()) }}
                    </button>

                    @auth
                        <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-gray-700 hover:text-blue-600">
                            Panel
                        </a>
                    @else
                        <a href="#" class="text-gray-700 hover:text-blue-600">
                            Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-600 hover:text-gray-900">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-lg font-bold mb-4">ISS-LOOPS</h3>
                    <p class="text-gray-400 text-sm">
                        Divulgación científica para mentes curiosas
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Enlaces</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-white">Artículos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Categorías</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Sobre Nosotros</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Categorías</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white">Física</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Biología</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Tecnología</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Newsletter</h3>
                    <p class="text-gray-400 text-sm mb-4">
                        Suscríbete para recibir las últimas noticias científicas
                    </p>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition">
                        Suscribirse
                    </button>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} ISS-LOOPS. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>