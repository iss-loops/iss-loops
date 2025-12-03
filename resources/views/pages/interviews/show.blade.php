@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', $interview->getTranslation('title', app()->getLocale()) . ' - ' . __('Interviews') . ' - ISS-LOOPS')
@section('description', Str::limit($interview->getTranslation('description', app()->getLocale()), 155) . ' Interview with ' . $interview->interviewee_name . '.')
@section('keywords', 'interview, ' . $interview->interviewee_name . ', ' . $interview->getTranslation('title', app()->getLocale()) . ', science talk, research conversation')

{{-- Open Graph --}}
@section('og_type', 'video.other')
@section('og_title', $interview->getTranslation('title', app()->getLocale()))
@section('og_description', 'Interview with ' . $interview->interviewee_name . '. ' . Str::limit($interview->getTranslation('description', app()->getLocale()), 150))
@section('og_image', $interview->thumbnail ? asset('storage/' . $interview->thumbnail) : asset('images/og-interviews.jpg'))
@section('og_video', $interview->video_url)

{{-- Twitter Card --}}
@section('twitter_card', 'player')
@section('twitter_player', $interview->video_url)

@section('content')
{{-- contenido --}}

@section('title', $interview->getTranslation('title', app()->getLocale()) . ' - ISS-LOOPS')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Header con Video --}}
    <div class="bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center space-x-2 text-sm text-gray-400 mb-6">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="hover:text-white transition">
                    {{ __('Home') }}
                </a>
                <span>/</span>
                <a href="{{ route('interviews.index', ['locale' => app()->getLocale()]) }}" class="hover:text-white transition">
                    {{ __('Interviews') }}
                </a>
                <span>/</span>
                <span class="text-white truncate">{{ $interview->getTranslation('title', app()->getLocale()) }}</span>
            </nav>

            {{-- Video Player --}}
            <div class="relative aspect-video bg-black rounded-xl overflow-hidden shadow-2xl">
                @if($interview->getEmbedUrl())
                    <iframe 
                        src="{{ $interview->getEmbedUrl() }}" 
                        class="absolute inset-0 w-full h-full"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                @elseif($interview->thumbnail)
                    <img src="{{ asset('storage/' . $interview->thumbnail) }}" 
                         alt="{{ $interview->getTranslation('title', app()->getLocale()) }}"
                         class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-20 h-20 rounded-full bg-white bg-opacity-90 flex items-center justify-center cursor-pointer hover:bg-opacity-100 transition">
                            <svg class="w-10 h-10 text-purple-600 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                            </svg>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Contenido Principal --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Columna Principal --}}
            <div class="lg:col-span-2">
                {{-- Título --}}
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ $interview->getTranslation('title', app()->getLocale()) }}
                </h1>

                {{-- Metadata --}}
                <div class="flex flex-wrap items-center gap-4 mb-6 pb-6 border-b border-gray-200">
                    {{-- Fecha --}}
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $interview->published_at->format('d M Y') }}
                    </div>

                    {{-- Duración --}}
                    @if($interview->duration)
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $interview->getFormattedDuration() }}
                    </div>
                    @endif

                    {{-- Categorías --}}
                    @if($interview->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
                        @foreach($interview->categories as $category)
                        <a href="{{ route('categories.show', ['locale' => app()->getLocale(), 'slug' => $category->slug]) }}"
                           class="px-3 py-1 rounded-full text-xs font-medium text-white hover:opacity-90 transition"
                           style="background-color: {{ $category->color }}">
                            {{ $category->getTranslation('name', app()->getLocale()) }}
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Entrevistado Info Card --}}
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('About the Interviewee') }}</h2>
                    <div class="flex items-start space-x-4">
                        @if($interview->interviewee_photo)
                        <img src="{{ asset('storage/' . $interview->interviewee_photo) }}" 
                             alt="{{ $interview->interviewee_name }}"
                             class="w-20 h-20 rounded-full object-cover flex-shrink-0">
                        @else
                        <div class="w-20 h-20 rounded-full bg-purple-200 flex items-center justify-center flex-shrink-0">
                            <span class="text-purple-700 font-bold text-2xl">
                                {{ substr($interview->interviewee_name, 0, 1) }}
                            </span>
                        </div>
                        @endif
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $interview->interviewee_name }}</h3>
                            @if($interview->interviewee_title)
                            <p class="text-gray-700 mt-1">{{ $interview->interviewee_title }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="prose prose-lg max-w-none mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('About this Interview') }}</h2>
                    <div class="text-gray-700 leading-relaxed">
                        {!! nl2br(e($interview->getTranslation('description', app()->getLocale()))) !!}
                    </div>
                </div>

                {{-- Tags --}}
                @if($interview->tags->isNotEmpty())
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('Topics Covered') }}</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($interview->tags as $tag)
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm">
                            #{{ $tag->getTranslation('name', app()->getLocale()) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Compartir --}}
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('Share this Interview') }}</h3>
                    <div class="flex gap-3">
                        {{-- Twitter --}}
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($interview->getTranslation('title', app()->getLocale())) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-400 text-white hover:bg-blue-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>

                        {{-- Facebook --}}
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>

                        {{-- LinkedIn --}}
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-700 text-white hover:bg-blue-800 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>

                        {{-- WhatsApp --}}
                        <a href="https://wa.me/?text={{ urlencode($interview->getTranslation('title', app()->getLocale()) . ' ' . url()->current()) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-green-500 text-white hover:bg-green-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1">
                {{-- Entrevistas Relacionadas --}}
                @if($relatedInterviews->count() > 0)
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">{{ __('Related Interviews') }}</h3>
                    <div class="space-y-4">
                        @foreach($relatedInterviews as $related)
                        <a href="{{ route('interviews.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) }}" 
                           class="block group">
                            <div class="flex space-x-3">
                                {{-- Thumbnail --}}
                                <div class="relative w-24 h-16 flex-shrink-0 rounded overflow-hidden bg-gray-200">
                                    @if($related->thumbnail)
                                    <img src="{{ asset('storage/' . $related->thumbnail) }}" 
                                         alt="{{ $related->getTranslation('title', app()->getLocale()) }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition">
                                    @else
                                    <div class="w-full h-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                        </svg>
                                    </div>
                                    @endif
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition"></div>
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900 group-hover:text-purple-600 transition line-clamp-2">
                                        {{ $related->getTranslation('title', app()->getLocale()) }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $related->interviewee_name }}
                                    </p>
                                    @if($related->duration)
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $related->getFormattedDuration() }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    {{-- Ver todas --}}
                    <a href="{{ route('interviews.index', ['locale' => app()->getLocale()]) }}" 
                       class="block mt-6 text-center text-purple-600 hover:text-purple-700 font-medium text-sm">
                        {{ __('View All Interviews') }} →
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection