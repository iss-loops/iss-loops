@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ __('My Favorites') }}
                </h1>
                <p class="mt-2 text-gray-600">
                    {{ __('Content you\'ve saved for later') }}
                </p>
            </div>

            {{-- Filtros por tipo --}}
            <div class="mb-6 flex flex-wrap gap-2">
                <a href="{{ route('favorites.index', ['locale' => app()->getLocale(), 'type' => 'all']) }}"
                   class="px-4 py-2 rounded-lg {{ $activeType === 'all' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    {{ __('All') }} ({{ auth()->user()->favorites()->count() }})
                </a>
                
                <a href="{{ route('favorites.index', ['locale' => app()->getLocale(), 'type' => 'articles']) }}"
                   class="px-4 py-2 rounded-lg {{ $activeType === 'articles' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    {{ __('Articles') }}
                </a>
            </div>

            {{-- Mensajes Flash --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Grid de Favoritos --}}
            @if($favorites->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">{{ __('No favorites yet') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ __('Start adding content to your favorites') }}</p>
                    <div class="mt-6">
                        <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            {{ __('Browse Articles') }}
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($favorites as $favorite)
                        @php
                            $item = $favorite->favorable;
                        @endphp
                        
                        @if($item)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                {{-- Imagen --}}
                                @if($item->featured_image)
                                    <img src="{{ asset('storage/' . $item->featured_image) }}" 
                                         alt="{{ $item->getTranslation('title', app()->getLocale()) }}"
                                         class="w-full h-48 object-cover">
                                @endif

                                <div class="p-6">
                                    {{-- Tipo de contenido --}}
                                    <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded mb-2">
                                        {{ class_basename($favorite->favorable_type) }}
                                    </span>

                                    {{-- Título --}}
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                        {{ $item->getTranslation('title', app()->getLocale()) }}
                                    </h3>

                                    {{-- Excerpt --}}
                                    @if($item->excerpt)
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                            {{ $item->getTranslation('excerpt', app()->getLocale()) }}
                                        </p>
                                    @endif

                                    {{-- Fecha --}}
                                    <p class="text-xs text-gray-500 mb-4">
                                        {{ __('Added') }}: {{ $favorite->created_at->diffForHumans() }}
                                    </p>

                                    {{-- Acciones --}}
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'slug' => $item->slug]) }}"
                                           class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                            {{ __('Read More') }} →
                                        </a>

                                        <form action="{{ route('favorites.destroy', ['locale' => app()->getLocale(), 'favorite' => $favorite->id]) }}" 
                                              method="POST"
                                              onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-700 text-sm">
                                                {{ __('Remove') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- Paginación --}}
                <div class="mt-8">
                    {{ $favorites->links() }}
                </div>

                {{-- Botón limpiar todos --}}
                @if($favorites->total() > 0)
                    <div class="mt-8 text-center">
                        <form action="{{ route('favorites.clear', ['locale' => app()->getLocale()]) }}" 
                              method="POST"
                              onsubmit="return confirm('{{ __('Remove all favorites?') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                {{ __('Clear All Favorites') }}
                            </button>
                        </form>
                    </div>
                @endif
            @endif

        </div>
    </div>
@endsection