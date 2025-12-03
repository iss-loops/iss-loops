@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', $article->getTranslation('title', app()->getLocale()) . ' - ISS-LOOPS')
@section('description', Str::limit(strip_tags($article->getTranslation('excerpt', app()->getLocale())), 155))
@section('keywords', implode(', ', $article->categories->pluck('name')->toArray()) . ', science, technology')

{{-- Open Graph --}}
@section('og_type', 'article')
@section('og_title', $article->getTranslation('title', app()->getLocale()))
@section('og_description', Str::limit(strip_tags($article->getTranslation('excerpt', app()->getLocale())), 200))
@section('og_image', $article->featured_image ? asset('storage/' . $article->featured_image) : asset('images/og-default.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary_large_image')
@section('twitter_title', $article->getTranslation('title', app()->getLocale()))
@section('twitter_description', Str::limit(strip_tags($article->getTranslation('excerpt', app()->getLocale())), 200))
@section('twitter_image', $article->featured_image ? asset('storage/' . $article->featured_image) : asset('images/og-default.jpg'))

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section con imagen --}}
    <div class="w-full h-96 bg-gradient-to-br from-blue-400 to-indigo-600 relative overflow-hidden">
        @if($article->featured_image)
            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                 alt="{{ $article->getTranslation('title', app()->getLocale()) }}"
                 class="w-full h-full object-cover opacity-40">
        @endif
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="max-w-4xl mx-auto">
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($article->categories as $category)
                        <span class="px-3 py-1 bg-white/90 rounded-full text-sm font-medium" 
                              style="color: {{ $category->color }}">
                            {{ $category->getTranslation('name', app()->getLocale()) }}
                        </span>
                    @endforeach
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                    {{ $article->getTranslation('title', app()->getLocale()) }}
                </h1>
                
                <div class="flex items-center gap-4 text-white/90 text-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $article->published_at->format('d M Y') }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ $article->reading_time }} {{ __('min read') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Article Content --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-xl shadow-lg p-8 md:p-12">
            {{-- Excerpt --}}
            <div class="text-xl text-gray-700 leading-relaxed mb-8 pb-8 border-b border-gray-200">
                {{ $article->getTranslation('excerpt', app()->getLocale()) }}
            </div>

            {{-- Body Content --}}
            <div class="prose prose-lg max-w-none">
                {!! $article->getTranslation('body', app()->getLocale()) !!}
            </div>

            {{-- Tags --}}
            @if($article->tags->count() > 0)
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">{{ __('Tags') }}</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($article->tags as $tag)
                        <span class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-full text-sm text-gray-700 transition">
                            {{ $tag->getTranslation('name', app()->getLocale()) }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Share Buttons --}}
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">{{ __('Share this article') }}</h3>
                <div class="flex gap-3">
                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank"
                       class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span>Facebook</span>
                    </a>

                    {{-- Twitter --}}
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->getTranslation('title', app()->getLocale())) }}" 
                       target="_blank"
                       class="flex items-center gap-2 px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                        <span>Twitter</span>
                    </a>

                    {{-- WhatsApp --}}
                    <a href="https://wa.me/?text={{ urlencode($article->getTranslation('title', app()->getLocale()) . ' ' . url()->current()) }}" 
                       target="_blank"
                       class="flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        <span>WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Related Articles --}}
        @if($relatedArticles->count() > 0)
        <div class="mt-16">
            <h2 class="text-3xl font-bold mb-8">{{ __('Related Articles') }}</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $related)
                <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($related->featured_image)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                 alt="{{ $related->getTranslation('title', app()->getLocale()) }}"
                                 class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-300">
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                            <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) }}" 
                               class="hover:text-blue-600 transition">
                                {{ $related->getTranslation('title', app()->getLocale()) }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $related->getTranslation('excerpt', app()->getLocale()) }}
                        </p>
                        
                        <a href="{{ route('articles.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                            {{ __('Read More') }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
