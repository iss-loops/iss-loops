@extends('layouts.app')

@section('title', $category->getTranslation('name', app()->getLocale()) . ' - ISS-LOOPS')

@section('meta')
    <meta name="description" content="{{ $category->getTranslation('description', app()->getLocale()) }}">
    <meta property="og:title" content="{{ $category->getTranslation('name', app()->getLocale()) }}">
    <meta property="og:description" content="{{ $category->getTranslation('description', app()->getLocale()) }}">
@endsection

@section('content')
<!-- Category Hero -->
<div class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 text-white py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm">
            <ol class="flex items-center space-x-2 text-blue-100">
                <li>
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="hover:text-white transition-colors">
                        {{ __('Inicio') }}
                    </a>
                </li>
                <li><span class="mx-2">/</span></li>
                <li>
                    <a href="{{ route('categories.index', ['locale' => app()->getLocale()]) }}" class="hover:text-white transition-colors">
                        {{ __('Categorías') }}
                    </a>
                </li>
                @if($category->parent)
                    <li><span class="mx-2">/</span></li>
                    <li>
                        <a href="{{ route('categories.show', ['locale' => app()->getLocale(), 'slug' => $category->parent->slug]) }}" class="hover:text-white transition-colors">
                            {{ $category->parent->getTranslation('name', app()->getLocale()) }}
                        </a>
                    </li>
                @endif
                <li><span class="mx-2">/</span></li>
                <li class="text-white font-medium">
                    {{ $category->getTranslation('name', app()->getLocale()) }}
                </li>
            </ol>
        </nav>

        <!-- Category Info -->
        <div class="flex items-start gap-6">
            @if($category->icon)
                <div class="flex-shrink-0 w-16 h-16 rounded-xl flex items-center justify-center text-white text-2xl"
                     style="background-color: {{ $category->color }}">
                    <i class="{{ $category->icon }}"></i>
                </div>
            @endif
            
            <div class="flex-1">
                <h1 class="text-4xl md:text-5xl font-bold mb-3">
                    {{ $category->getTranslation('name', app()->getLocale()) }}
                </h1>
                
                @if($category->description)
                    <p class="text-xl text-blue-100 max-w-3xl">
                        {{ $category->getTranslation('description', app()->getLocale()) }}
                    </p>
                @endif

                <div class="mt-4 flex items-center gap-4 text-sm text-blue-100">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ $articles->total() }} {{ __('artículos') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Subcategories -->
        @if($category->children->isNotEmpty())
            <div class="mt-8 pt-8 border-t border-blue-800">
                <h3 class="text-sm font-medium text-blue-100 mb-3">{{ __('Subcategorías') }}:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($category->children as $child)
                        <a href="{{ route('categories.show', ['locale' => app()->getLocale(), 'slug' => $child->slug]) }}" 
                           class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 backdrop-blur-sm transition-colors text-white text-sm font-medium">
                            {{ $child->getTranslation('name', app()->getLocale()) }}
                            @if($child->articles_count > 0)
                                <span class="ml-2 text-xs opacity-75">({{ $child->articles_count }})</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Articles Grid -->
<div class="container mx-auto px-4 py-12">
    @if($articles->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($articles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">{{ __('No hay artículos en esta categoría') }}</h3>
            <p class="mt-2 text-gray-500">{{ __('Próximamente agregaremos contenido a esta sección') }}</p>
            <div class="mt-6">
                <a href="{{ route('articles.index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    {{ __('Ver todos los artículos') }}
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Related Categories -->
@if($relatedCategories->isNotEmpty())
    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Categorías relacionadas') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($relatedCategories as $related)
                    <a href="{{ route('categories.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) }}" 
                       class="block bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow p-4 text-center">
                        @if($related->icon)
                            <div class="w-12 h-12 mx-auto rounded-lg flex items-center justify-center text-white text-xl mb-2"
                                 style="background-color: {{ $related->color }}">
                                <i class="{{ $related->icon }}"></i>
                            </div>
                        @endif
                        <h3 class="text-sm font-medium text-gray-900 line-clamp-2">
                            {{ $related->getTranslation('name', app()->getLocale()) }}
                        </h3>
                        @if($related->articles_count > 0)
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $related->articles_count }} {{ __('artículos') }}
                            </p>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection