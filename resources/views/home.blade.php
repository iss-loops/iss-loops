{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Inicio - Divulgación Científica')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-600 via-purple-600 to-pink-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">
                    Divulgación Científica para Mentes Curiosas
                </h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90">
                    Descubre los últimos avances en ciencia y tecnología
                </p>
                <div class="flex gap-4 justify-center">
                    <a href="/articulos" 
                       class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition transform hover:scale-105">
                        Explorar Artículos
                    </a>
                    <a href="#newsletter" 
                       class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                        Suscribirse
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Articles -->
    @if($featuredArticles->count() > 0)
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Artículos Destacados</h2>
                <p class="text-gray-600">Los temas más importantes del momento</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($featuredArticles as $article)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-600"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">
                            <a href="/articulos/{{ $article->slug }}" class="hover:text-blue-600 transition">
                                {{ $article->title['es'] ?? $article->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $article->excerpt['es'] ?? $article->excerpt ?? 'Sin descripción' }}
                        </p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>📖 {{ $article->reading_time ?? 5 }} min</span>
                            <span>📅 {{ $article->published_at ? $article->published_at->format('d/m/Y') : 'Sin fecha' }}</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Recent Articles -->
    @if($recentArticles->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Últimos Artículos</h2>
                <p class="text-gray-600">Mantente al día con la ciencia</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($recentArticles as $article)
                <article class="bg-white rounded-lg shadow hover:shadow-xl transition-all">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">
                            <a href="/articulos/{{ $article->slug }}" class="hover:text-blue-600 transition">
                                {{ $article->title['es'] ?? $article->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ $article->excerpt['es'] ?? $article->excerpt ?? 'Sin descripción' }}
                        </p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $article->reading_time ?? 5 }} min</span>
                            <span>{{ $article->published_at ? $article->published_at->format('d/m/Y') : '' }}</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="/articulos" 
                   class="inline-flex items-center bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Ver Todos los Artículos
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif
@endsection