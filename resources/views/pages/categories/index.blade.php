@extends('layouts.app')

@section('title', __('Categorías') . ' - ISS-LOOPS')

@section('meta')
    <meta name="description" content="{{ __('Explora todas las categorías de contenido científico en ISS-LOOPS') }}">
@endsection

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ __('Explora por Categoría') }}
            </h1>
            <p class="text-xl text-blue-100">
                {{ __('Descubre contenido científico organizado por áreas de conocimiento') }}
            </p>
        </div>
    </div>
</div>

<!-- Categories Grid -->
<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <a href="{{ route('categories.show', ['locale' => app()->getLocale(), 'slug' => $category->slug]) }}"
               class="group block bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">

                <!-- Header con color de categoría -->
                <div class="h-2" style="background-color: {{ $category->color }}"></div>

                <div class="p-6">
                    <!-- Icon y Nombre -->
                    <div class="flex items-start gap-4 mb-4">
                        @if($category->icon)
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center text-white text-xl"
                                 style="background-color: {{ $category->color }}">
                                <i class="{{ $category->icon }}"></i>
                            </div>
                        @endif

                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                {{ $category->getTranslation('name', app()->getLocale()) }}
                            </h3>

                            @if($category->articles_count > 0)
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $category->articles_count }} {{ __('artículos') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Descripción -->
                    @if($category->description)
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                            {{ $category->getTranslation('description', app()->getLocale()) }}
                        </p>
                    @endif

                    <!-- Subcategorías -->
                    @if($category->children->isNotEmpty())
                        <div class="pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-500 mb-2">{{ __('Subcategorías') }}:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($category->children->take(4) as $child)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $child->getTranslation('name', app()->getLocale()) }}
                                    </span>
                                @endforeach

                                @if($category->children->count() > 4)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                        +{{ $category->children->count() - 4 }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Arrow -->
                    <div class="mt-4 flex items-center text-blue-600 text-sm font-medium group-hover:translate-x-1 transition-transform">
                        {{ __('Explorar categoría') }}
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    @if($categories->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            <p class="mt-4 text-lg text-gray-600">{{ __('No hay categorías disponibles') }}</p>
        </div>
    @endif
</div>
@endsection
