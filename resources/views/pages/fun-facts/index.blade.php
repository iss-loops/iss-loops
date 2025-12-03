@extends('layouts.app')

@section('title', __('Fun Facts') . ' - ISS-LOOPS')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    {{ __('Fun Facts') }}
                </h1>
                <p class="text-xl text-purple-100 max-w-3xl mx-auto">
                    {{ __('Discover amazing and surprising facts about science') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Carrusel Destacado --}}
    @if($randomFacts->count() > 0)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('Featured Facts') }}</h2>
            <p class="text-gray-600">{{ __('Random selection of interesting facts') }}</p>
        </div>

        {{-- Swiper Carousel --}}
        <div class="swiper funFactsSwiper relative">
            <div class="swiper-wrapper pb-12">
                @foreach($randomFacts as $fact)
                <div class="swiper-slide">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden h-full transition-transform duration-300 hover:scale-105">
                        @if($fact->image)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $fact->image) }}" 
                                 alt="{{ $fact->getTranslation('title', app()->getLocale()) }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        @else
                        <div class="relative h-48 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                            <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        @endif
                        
                        <div class="p-6">
                            @if($fact->category)
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-3"
                                  style="background-color: {{ $fact->category->color }}20; color: {{ $fact->category->color }}">
                                {{ $fact->category->getTranslation('name', app()->getLocale()) }}
                            </span>
                            @endif
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                {{ $fact->getTranslation('title', app()->getLocale()) }}
                            </h3>
                            
                            <p class="text-gray-600 line-clamp-4">
                                {{ $fact->getTranslation('content', app()->getLocale()) }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            {{-- Navigation --}}
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            
            {{-- Pagination --}}
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @endif

    {{-- Grid de Todos los Fun Facts --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('All Fun Facts') }}</h2>
            <p class="text-gray-600">{{ __('Browse all our scientific curiosities') }}</p>
        </div>

        @if($funFacts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($funFacts as $fact)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                @if($fact->image)
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $fact->image) }}" 
                         alt="{{ $fact->getTranslation('title', app()->getLocale()) }}"
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                </div>
                @else
                <div class="relative h-48 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                    <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                @endif
                
                <div class="p-6">
                    @if($fact->category)
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-3"
                          style="background-color: {{ $fact->category->color }}20; color: {{ $fact->category->color }}">
                        {{ $fact->category->getTranslation('name', app()->getLocale()) }}
                    </span>
                    @endif
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        {{ $fact->getTranslation('title', app()->getLocale()) }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $fact->getTranslation('content', app()->getLocale()) }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
            <p class="text-gray-500">{{ __('No fun facts available yet') }}</p>
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
{{-- Swiper CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<style>
    .funFactsSwiper {
        padding: 0 40px;
    }
    .funFactsSwiper .swiper-button-next,
    .funFactsSwiper .swiper-button-prev {
        color: #9333ea;
    }
    .funFactsSwiper .swiper-pagination-bullet-active {
        background-color: #9333ea;
    }
</style>
@endpush

@push('scripts')
{{-- Swiper JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.funFactsSwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    });
</script>
@endpush