{{-- resources/views/components/layouts/navigation.blade.php --}}
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        ISS-LOOPS
                    </span>
                </a>

                <!-- Navigation Links Desktop -->
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <a href="/" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition">
                        {{ __('Inicio') }}
                    </a>
                    <a href="/articulos" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition">
                        {{ __('Artículos') }}
                    </a>
                    <a href="/categorias" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition">
                        {{ __('Categorías') }}
                    </a>
                    <a href="/sobre-nosotros" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition">
                        {{ __('Nosotros') }}
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Language Switcher (placeholder por ahora) -->
                <div class="relative">
                    <button class="flex items-center text-sm text-gray-700 hover:text-blue-600">
                        <span>{{ app()->getLocale() == 'es' ? '🇪🇸 ES' : '🇬🇧 EN' }}</span>
                    </button>
                </div>

                <!-- Auth Links -->
                @auth
                    <a href="/favoritos" class="text-gray-700 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </a>
                    <a href="/perfil" class="text-gray-700 hover:text-blue-600 font-medium">
                        {{ Auth::user()->name }}
                    </a>
                @else
                    <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                        {{ __('Iniciar Sesión') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>