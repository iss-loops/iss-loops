{{-- resources/views/layouts/partials/nav.blade.php --}}
<nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false, searchOpen: false }">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
<div class="flex items-center">
    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">
        <img src="{{ asset('images/loops.svg') }}" 
             alt="LOOPS - Scientific Communication" 
             class="h-12 w-auto">
             
    </a>
     
</div>
        {{-- Desktop Navigation --}}
        <div class="hidden md:flex items-center space-x-1">
            {{-- Home --}}
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
               class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                {{ __('Inicio') }}
            </a>

            {{-- Artículos --}}
            <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}"
               class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('articles.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                {{ __('Artículos') }}
            </a>

            {{-- Categorías Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                        @click.away="open = false"
                        class="flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                    {{ __('Categorías') }}
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute left-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-100 py-2"
                     style="display: none;">

                    {{-- Ver todas las categorías --}}
                    <a href="{{ route('categories.index', ['locale' => app()->getLocale()]) }}"
                       class="flex items-center gap-2 px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ __('Ver todas las categorías') }}</div>
                            <div class="text-xs text-gray-500">{{ __('Explorar todas las áreas') }}</div>
                        </div>
                    </a>

                    {{-- Lista de Categorías Dinámicas --}}
                    @php
                        try {
                            $categories = \App\Modules\Category\Models\Category::query()
                                ->where('is_active', true)
                                ->whereNull('parent_id')
                                ->withCount('articles')
                                ->orderBy('sort_order')
                                ->limit(6)
                                ->get();
                        } catch (\Exception $e) {
                            $categories = collect();
                        }
                    @endphp

                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', ['locale' => app()->getLocale(), 'slug' => $category->slug]) }}"
                           class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors group">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                                 style="background-color: {{ $category->color }}">
                                <span class="w-2 h-2 bg-white rounded-full"></span>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 group-hover:text-blue-600">
                                    {{ $category->getTranslation('name', app()->getLocale()) }}
                                </div>
                                @if($category->articles_count > 0)
                                    <div class="text-xs text-gray-500">
                                        {{ $category->articles_count }} {{ __('artículos') }}
                                    </div>
                                @endif
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Entrevistas --}}
            <a href="{{ route('interviews.index', ['locale' => app()->getLocale()]) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('interviews.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                {{ __('Entrevistas') }}
            </a>

            {{-- Datos Curiosos --}}
            <a href="{{ route('fun-facts.index', ['locale' => app()->getLocale()]) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('fun-facts.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                {{ __('Datos Curiosos') }}
            </a>

            {{-- Dropdown "Más" --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                        @click.away="open = false"
                        class="flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs(['festival.*', 'about', 'contact']) ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                    {{ __('More') }}
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-100 py-2"
                     style="display: none;">

                    {{-- Festival DGETI --}}
                    <a href="{{ route('festival.index', ['locale' => app()->getLocale()]) }}"
                       class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors group">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900 group-hover:text-purple-600">
                                {{ __('DGETI Festival') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ __('Related Winners') }}
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-purple-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    {{-- Games --}}
<a href="{{ route('games.index', ['locale' => app()->getLocale()]) }}"
   class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors group">
    <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center">
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <div class="flex-1">
        <div class="text-sm font-medium text-gray-900 group-hover:text-green-600">
            {{ __('Games') }}
        </div>
        <div class="text-xs text-gray-500">
            {{ __('Interactive Simulations') }}
        </div>
    </div>
    <svg class="w-4 h-4 text-gray-400 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
</a>

                    <div class="border-t border-gray-100 my-1"></div>

                    {{-- Sobre Nosotros --}}
                    <a href="{{ route('about', ['locale' => app()->getLocale()]) }}"
                       class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors group">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900 group-hover:text-blue-600">
                                {{ __('About Us') }}
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>

                    {{-- Contacto --}}
                    <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}"
                       class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors group">
                        <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900 group-hover:text-amber-600">
                                {{ __('Contact') }}
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-amber-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Side Actions --}}
        <div class="flex items-center space-x-2">
            {{-- Search Button (Desktop) --}}
            <div class="hidden md:block">
                <button @click="searchOpen = !searchOpen"
                        class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>

            @auth
                {{-- Usuario Autenticado - Dropdown Menu --}}
                <div class="hidden md:block relative" x-data="{ userMenuOpen: false }">
                    <button @click="userMenuOpen = !userMenuOpen"
                            @click.away="userMenuOpen = false"
                            class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                        <span class="max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="userMenuOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 py-1"
                         style="display: none;">
                        
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('favorites.index', ['locale' => app()->getLocale()]) }}"
                           class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span>{{ __('My Favorites') }}</span>
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>

                        <form method="POST" action="{{ route('logout', ['locale' => app()->getLocale()]) }}">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>{{ __('Logout') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('login', ['locale' => app()->getLocale()]) }}"
                       class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                        {{ __('Login') }}
                    </a>
                    <a href="{{ route('register', ['locale' => app()->getLocale()]) }}"
                       class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                        {{ __('Register') }}
                    </a>
                </div>
            @endauth

            {{-- Language Switcher Desktop --}}
            <div class="relative ml-3" x-data="{ open: false }">
                <button @click="open = !open" 
                        type="button" 
                        class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    <span>{{ strtoupper(app()->getLocale()) }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" 
                     @click.away="open = false"
                     x-transition
                     class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg py-1 z-50">
                    @php
                        // Obtener la ruta actual sin el locale
                        $currentPath = request()->path();
                        $currentLocale = app()->getLocale();
                        
                        // Remover el locale actual del path
                        if (str_starts_with($currentPath, $currentLocale . '/')) {
                            $pathWithoutLocale = substr($currentPath, strlen($currentLocale) + 1);
                        } elseif ($currentPath === $currentLocale) {
                            $pathWithoutLocale = '';
                        } else {
                            $pathWithoutLocale = $currentPath;
                        }
                    @endphp
                    
                    <a href="{{ url('es/' . $pathWithoutLocale) }}" 
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() == 'es' ? 'bg-blue-50 font-semibold' : '' }}">
                        🇪🇸 Español
                    </a>
                    <a href="{{ url('en/' . $pathWithoutLocale) }}" 
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() == 'en' ? 'bg-blue-50 font-semibold' : '' }}">
                        🇬🇧 English
                    </a>
                </div>
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Desktop Search Bar --}}
    <div x-show="searchOpen"
         x-transition
         class="hidden md:block py-4 border-t border-gray-100"
         style="display: none;">
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('articles.index', ['locale' => app()->getLocale()]) }}" method="GET" class="relative">
                <input type="search"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="{{ __('Buscar artículos...') }}"
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                       autocomplete="off">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Mobile Menu --}}
<div x-show="mobileMenuOpen"
     x-transition
     class="md:hidden border-t border-gray-100"
     style="display: none;">
    <div class="px-4 py-4 space-y-2">
        <div class="mb-4">
            <form action="{{ route('articles.index', ['locale' => app()->getLocale()]) }}" method="GET">
                <div class="relative">
                    <input type="search"
                           name="search"
                           placeholder="{{ __('Buscar artículos...') }}"
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        @auth
            <div class="mb-4 pb-4 border-b border-gray-200">
                <div class="flex items-center gap-3 px-4 py-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <a href="{{ route('favorites.index', ['locale' => app()->getLocale()]) }}"
                   class="flex items-center gap-3 px-4 py-2 mt-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span>{{ __('My Favorites') }}</span>
                </a>

                <form method="POST" action="{{ route('logout', ['locale' => app()->getLocale()]) }}" class="mt-2">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>{{ __('Logout') }}</span>
                    </button>
                </form>
            </div>
        @else
            <div class="mb-4 pb-4 border-b border-gray-200 space-y-2">
                <a href="{{ route('login', ['locale' => app()->getLocale()]) }}"
                   class="block w-full text-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register', ['locale' => app()->getLocale()]) }}"
                   class="block w-full text-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    {{ __('Register') }}
                </a>
            </div>
        @endauth

        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
           class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
            {{ __('Inicio') }}
        </a>
        <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}"
           class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
            {{ __('Artículos') }}
        </a>
        <a href="{{ route('categories.index', ['locale' => app()->getLocale()]) }}"
           class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
            {{ __('Categorías') }}
        </a>
        <a href="{{ route('interviews.index', ['locale' => app()->getLocale()]) }}"
           class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
            {{ __('Entrevistas') }}
        </a>
        <a href="{{ route('fun-facts.index', ['locale' => app()->getLocale()]) }}"
           class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
            {{ __('Datos Curiosos') }}
        </a>

        {{-- Menú Más Mobile --}}
        <div class="pt-2 mt-2 border-t border-gray-200">
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 mb-2">
                {{ __('Más') }}
            </div>
            
            <a href="{{ route('festival.index', ['locale' => app()->getLocale()]) }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span>{{ __('Festival DGETI') }}</span>
            </a>

            <div class="flex items-center gap-3 px-4 py-2 opacity-50">
                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-500">{{ __('Juegos') }} ({{ __('Próximamente') }})</span>
            </div>

            <a href="{{ route('about', ['locale' => app()->getLocale()]) }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span>{{ __('About Us') }}</span>
            </a>

            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span>{{ __('Contact') }}</span>
            </a>
        </div>

        {{-- Mobile Language Switcher --}}
        <div class="pt-4 mt-4 border-t border-gray-200">
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 mb-2">
                {{ __('Idioma') }}
            </div>
            <a href="{{ url('es/' . ltrim(request()->path(), app()->getLocale() . '/')) }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium {{ app()->getLocale() == 'es' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="text-lg">🇪🇸</span>
                <span>Español</span>
            </a>
            <a href="{{ url('en/' . ltrim(request()->path(), app()->getLocale() . '/')) }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium {{ app()->getLocale() == 'en' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                <span class="text-lg">🇬🇧</span>
                <span>English</span>
            </a>
        </div>
    </div>
</div>
</nav>
</parameter>