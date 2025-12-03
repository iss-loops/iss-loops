@extends('layouts.app')

@section('title', __('Artículos') . ' - ISS-LOOPS')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ __('Artículos Científicos') }}
            </h1>
            <p class="text-xl text-blue-100">
                {{ __('Explora contenido de divulgación científica de calidad') }}
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar con Filtros -->
        <aside class="lg:w-64 flex-shrink-0">
            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    {{ __('Filtros') }}
                </h2>

                <!-- Búsqueda -->
                <form method="GET" action="{{ route('articles.index', ['locale' => app()->getLocale()]) }}" class="mb-6">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Buscar') }}
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="search"
                               name="search"
                               value="{{ $activeFilters['search'] }}"
                               placeholder="{{ __('Buscar artículos...') }}"
                               class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Categorías -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">{{ __('Categorías') }}</h3>
                    <div class="space-y-2">
                        <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}"
                           class="block px-3 py-2 rounded-lg text-sm transition-colors {{ !$activeFilters['category'] ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            {{ __('Todas') }}
                            <span class="text-xs opacity-75">({{ $articles->total() }})</span>
                        </a>

                        @foreach($categories as $category)
                            <a href="{{ route('articles.index', ['locale' => app()->getLocale(), 'category' => $category->slug]) }}"
                               class="flex items-center justify-between px-3 py-2 rounded-lg text-sm transition-colors {{ $activeFilters['category'] === $category->slug ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                                <span class="flex items-center gap-2">
                                    @if($category->icon)
                                        <span class="w-5 h-5 rounded flex items-center justify-center text-xs text-white"
                                              style="background-color: {{ $category->color }}">
                                            <i class="{{ $category->icon }}"></i>
                                        </span>
                                    @endif
                                    {{ $category->getTranslation('name', app()->getLocale()) }}
                                </span>
                                <span class="text-xs opacity-75">({{ $category->articles_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Tags Populares -->
                @if($popularTags->isNotEmpty())
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">{{ __('Tags Populares') }}</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($popularTags->take(10) as $tag)
                                <a href="{{ route('articles.index', ['locale' => app()->getLocale(), 'tag' => $tag->slug]) }}"
                                   class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors {{ $activeFilters['tag'] === $tag->slug ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                    {{ $tag->getTranslation('name', app()->getLocale()) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Ordenamiento -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">{{ __('Ordenar por') }}</h3>
                    <select name="sort"
                            onchange="window.location.href = '{{ route('articles.index', ['locale' => app()->getLocale()]) }}?sort=' + this.value + '{{ $activeFilters['category'] ? '&category=' . $activeFilters['category'] : '' }}{{ $activeFilters['tag'] ? '&tag=' . $activeFilters['tag'] : '' }}{{ $activeFilters['search'] ? '&search=' . $activeFilters['search'] : '' }}'"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="recent" {{ $activeFilters['sort'] === 'recent' ? 'selected' : '' }}>{{ __('Más recientes') }}</option>
                        <option value="oldest" {{ $activeFilters['sort'] === 'oldest' ? 'selected' : '' }}>{{ __('Más antiguos') }}</option>
                        <option value="featured" {{ $activeFilters['sort'] === 'featured' ? 'selected' : '' }}>{{ __('Destacados') }}</option>
                    </select>
                </div>

                <!-- Limpiar Filtros -->
                @if($activeFilters['category'] || $activeFilters['tag'] || $activeFilters['search'])
                    <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}"
                       class="block w-full text-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                        {{ __('Limpiar filtros') }}
                    </a>
                @endif
            </div>
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1">
            <!-- Filtros Activos (mobile friendly) -->
            @if($activeFilters['category'] || $activeFilters['tag'] || $activeFilters['search'])
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-sm font-medium text-blue-900">{{ __('Filtros activos') }}:</h3>
                        <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}" class="text-sm text-blue-600 hover:text-blue-700">
                            {{ __('Limpiar todos') }}
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @if($activeFilters['category'])
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-white rounded-full text-sm">
                                <span class="text-gray-600">{{ __('Categoría') }}:</span>
                                <span class="font-medium">{{ $activeFilters['category'] }}</span>
                                <a href="{{ route('articles.index', array_merge(['locale' => app()->getLocale()], array_filter(['tag' => $activeFilters['tag'], 'search' => $activeFilters['search']]))) }}"
                                   class="ml-1 text-gray-400 hover:text-gray-600">×</a>
                            </span>
                        @endif

                        @if($activeFilters['tag'])
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-white rounded-full text-sm">
                                <span class="text-gray-600">{{ __('Tag') }}:</span>
                                <span class="font-medium">{{ $activeFilters['tag'] }}</span>
                                <a href="{{ route('articles.index', array_merge(['locale' => app()->getLocale()], array_filter(['category' => $activeFilters['category'], 'search' => $activeFilters['search']]))) }}"
                                   class="ml-1 text-gray-400 hover:text-gray-600">×</a>
                            </span>
                        @endif

                        @if($activeFilters['search'])
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-white rounded-full text-sm">
                                <span class="text-gray-600">{{ __('Búsqueda') }}:</span>
                                <span class="font-medium">{{ $activeFilters['search'] }}</span>
                                <a href="{{ route('articles.index', array_merge(['locale' => app()->getLocale()], array_filter(['category' => $activeFilters['category'], 'tag' => $activeFilters['tag']]))) }}"
                                   class="ml-1 text-gray-400 hover:text-gray-600">×</a>
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Contador de Resultados -->
            <div class="flex items-center justify-between mb-6">
                <p class="text-sm text-gray-600">
                    {{ __('Mostrando') }}
                    <span class="font-medium">{{ $articles->firstItem() ?? 0 }}</span>
                    -
                    <span class="font-medium">{{ $articles->lastItem() ?? 0 }}</span>
                    {{ __('de') }}
                    <span class="font-medium">{{ $articles->total() }}</span>
                    {{ __('artículos') }}
                </p>
            </div>

            <!-- Grid de Artículos -->
            @if($articles->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                    @foreach($articles as $article)
                        <x-article-card :article="$article" />
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            @else
                <!-- Estado Vacío -->
                <div class="text-center py-16 bg-white rounded-lg">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">{{ __('No se encontraron artículos') }}</h3>
                    <p class="mt-2 text-gray-500">{{ __('Intenta ajustar los filtros o buscar con otros términos') }}</p>
                    <div class="mt-6">
                        <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            {{ __('Ver todos los artículos') }}
                        </a>
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
