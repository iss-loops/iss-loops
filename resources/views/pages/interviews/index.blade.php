@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', __('Interviews') . ' - ' . __('Conversations with Scientists') . ' - ISS-LOOPS')
@section('description', __('Watch exclusive interviews with leading scientists, researchers and innovators. Learn from experts about cutting-edge science and technology.'))
@section('keywords', 'science interviews, scientist talks, research conversations, expert interviews, scientific community, entrevistas científicas, conversaciones con científicos')

{{-- Open Graph --}}
@section('og_type', 'website')
@section('og_title', __('Scientific Interviews') . ' - ISS-LOOPS')
@section('og_description', __('Exclusive conversations with leading scientists and innovators'))
@section('og_image', asset('images/og-interviews.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary_large_image')
@section('twitter_title', __('Scientific Interviews'))
@section('twitter_description', __('Watch exclusive conversations with experts'))

@section('content')
{{-- El contenido existente --}}

@section('title', __('Interviews') . ' - ISS-LOOPS')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ __('Interviews') }}
            </h1>
            <p class="text-xl text-purple-100 max-w-2xl">
                {{ __('Conversations with experts and scientists from around the world') }}
            </p>
        </div>
    </div>

    {{-- Entrevista Destacada --}}
    @if($featuredInterview)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 mb-12">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="grid md:grid-cols-2 gap-0">
                {{-- Video --}}
                <div class="relative aspect-video bg-gray-900">
                    @if($featuredInterview->getEmbedUrl())
                        <iframe 
                            src="{{ $featuredInterview->getEmbedUrl() }}" 
                            class="absolute inset-0 w-full h-full"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    @elseif($featuredInterview->thumbnail)
                        <img src="{{ asset('storage/' . $featuredInterview->thumbnail) }}" 
                             alt="{{ $featuredInterview->getTranslation('title', app()->getLocale()) }}"
                             class="absolute inset-0 w-full h-full object-cover">
                    @endif
                    
                    {{-- Badge Featured --}}
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-600 text-white">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            {{ __('Featured') }}
                        </span>
                    </div>
                    
                    {{-- Duration --}}
                    @if($featuredInterview->duration)
                    <div class="absolute bottom-4 right-4">
                        <span class="px-2 py-1 bg-black bg-opacity-75 text-white text-sm rounded">
                            {{ $featuredInterview->getFormattedDuration() }}
                        </span>
                    </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $featuredInterview->getTranslation('title', app()->getLocale()) }}
                    </h2>
                    
                    {{-- Entrevistado --}}
                    <div class="flex items-center space-x-4 mb-4">
                        @if($featuredInterview->interviewee_photo)
                        <img src="{{ asset('storage/' . $featuredInterview->interviewee_photo) }}" 
                             alt="{{ $featuredInterview->interviewee_name }}"
                             class="w-12 h-12 rounded-full object-cover">
                        @else
                        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                            <span class="text-purple-600 font-bold text-lg">
                                {{ substr($featuredInterview->interviewee_name, 0, 1) }}
                            </span>
                        </div>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-900">{{ $featuredInterview->interviewee_name }}</p>
                            @if($featuredInterview->interviewee_title)
                            <p class="text-sm text-gray-600">{{ $featuredInterview->interviewee_title }}</p>
                            @endif
                        </div>
                    </div>

                    <p class="text-gray-600 mb-6">
                        {{ $featuredInterview->getTranslation('description', app()->getLocale()) }}
                    </p>

                    {{-- Categorías --}}
                    @if($featuredInterview->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($featuredInterview->categories as $category)
                        <span class="px-3 py-1 rounded-full text-xs font-medium text-white"
                              style="background-color: {{ $category->color }}">
                            {{ $category->getTranslation('name', app()->getLocale()) }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    <a href="{{ route('interviews.show', ['locale' => app()->getLocale(), 'slug' => $featuredInterview->slug]) }}" 
                       class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition">
                        {{ __('Watch Interview') }}
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Listado de Entrevistas --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">{{ __('All Interviews') }}</h2>

        @if($interviews->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($interviews as $interview)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group">
                {{-- Thumbnail --}}
                <a href="{{ route('interviews.show', ['locale' => app()->getLocale(), 'slug' => $interview->slug]) }}" 
                   class="block relative aspect-video bg-gray-900 overflow-hidden">
                    @if($interview->thumbnail)
                    <img src="{{ asset('storage/' . $interview->thumbnail) }}" 
                         alt="{{ $interview->getTranslation('title', app()->getLocale()) }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-500 to-pink-500">
                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                        </svg>
                    </div>
                    @endif

                    {{-- Play Overlay --}}
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition flex items-center justify-center">
                        <div class="transform scale-0 group-hover:scale-100 transition">
                            <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center">
                                <svg class="w-8 h-8 text-purple-600 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Duration --}}
                    @if($interview->duration)
                    <div class="absolute bottom-2 right-2">
                        <span class="px-2 py-1 bg-black bg-opacity-75 text-white text-xs rounded">
                            {{ $interview->getFormattedDuration() }}
                        </span>
                    </div>
                    @endif
                </a>

                {{-- Content --}}
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                        <a href="{{ route('interviews.show', ['locale' => app()->getLocale(), 'slug' => $interview->slug]) }}" 
                           class="hover:text-purple-600 transition">
                            {{ $interview->getTranslation('title', app()->getLocale()) }}
                        </a>
                    </h3>

                    {{-- Entrevistado --}}
                    <p class="text-sm text-gray-600 mb-3">
                        {{ __('Interview with') }} <span class="font-semibold">{{ $interview->interviewee_name }}</span>
                    </p>

                    {{-- Categorías --}}
                    @if($interview->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-1 mb-3">
                        @foreach($interview->categories->take(2) as $category)
                        <span class="px-2 py-1 rounded text-xs font-medium text-white"
                              style="background-color: {{ $category->color }}">
                            {{ $category->getTranslation('name', app()->getLocale()) }}
                        </span>
                        @endforeach
                    </div>
                    @endif

                    {{-- Fecha --}}
                    <p class="text-xs text-gray-500">
                        {{ $interview->published_at->format('d M Y') }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        <div class="mt-12">
            {{ $interviews->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500">{{ __('No interviews available yet') }}</p>
        </div>
        @endif
    </div>
</div>
@endsection