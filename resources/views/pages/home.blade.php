@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', __('ISS-LOOPS - Scientific Communication Magazine'))
@section('description', __('Explore fascinating scientific articles in Spanish and English. Quantum computing, space exploration, biology, physics, and emerging technologies explained for everyone.'))
@section('keywords', 'scientific magazine, science articles, quantum computing, space exploration, biology, physics, bilingual magazine, divulgación científica, revista científica')

{{-- Open Graph --}}
@section('og_type', 'website')
@section('og_title', __('ISS-LOOPS - Making Science Accessible'))
@section('og_description', __('Bilingual scientific magazine with articles about quantum computing, space, biology, and technology'))
@section('og_image', asset('images/og-home.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary_large_image')
@section('twitter_title', __('ISS-LOOPS - Scientific Magazine'))
@section('twitter_description', __('Explore science in Spanish and English'))

@section('content')
{{-- El resto del contenido existente --}}

@section('title', __('ISS-LOOPS - Divulgación Científica'))

@section('content')
    {{-- Hero Section --}}
    <div class="bg-gradient-to-br from-blue-600 via-purple-600 to-pink-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    ISS-LOOPS
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                    {{ __('Divulgación científica para mentes curiosas. Explorando el universo del conocimiento.') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Featured Articles Section --}}
    @if($featuredArticles->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">{{ __('Artículos Destacados') }}</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($featuredArticles as $article)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            @if($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                     alt="{{ $article->getTranslation('title', app()->getLocale()) }}"
                                     class="w-full h-48 object-cover">
                            @endif
                            
                            <div class="p-6">
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach($article->categories as $category)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full text-white"
                                              style="background-color: {{ $category->color }}">
                                            {{ $category->getTranslation('name', app()->getLocale()) }}
                                        </span>
                                    @endforeach
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                    {{ $article->getTranslation('title', app()->getLocale()) }}
                                </h3>
                                
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $article->getTranslation('excerpt', app()->getLocale()) }}
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        {{ $article->reading_time }} {{ __('min de lectura') }}
                                    </span>
                                    <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-medium">
                                        {{ __('Leer más') }} →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Recent Articles Section --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">{{ __('Últimos Artículos') }}</h2>
                <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}" 
                   class="text-blue-600 hover:text-blue-800 font-medium">
                    {{ __('Ver todos los artículos') }} →
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($recentArticles as $article)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        @if($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                 alt="{{ $article->getTranslation('title', app()->getLocale()) }}"
                                 class="w-full h-48 object-cover">
                        @endif
                        
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($article->categories as $category)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full text-white"
                                          style="background-color: {{ $category->color }}">
                                        {{ $category->getTranslation('name', app()->getLocale()) }}
                                    </span>
                                @endforeach
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                {{ $article->getTranslation('title', app()->getLocale()) }}
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ $article->getTranslation('excerpt', app()->getLocale()) }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    {{ $article->reading_time }} {{ __('min de lectura') }}
                                </span>
                                <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ __('Leer más') }} →
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection