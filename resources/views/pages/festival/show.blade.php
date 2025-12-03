@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', $winner->getTranslation('student_name', app()->getLocale()) . ' - ' . __('DGETI Festival') . ' - ISS-LOOPS')
@section('description', $winner->getTranslation('project_title', app()->getLocale()) . '. ' . Str::limit($winner->getTranslation('project_description', app()->getLocale()), 140))
@section('keywords', 'DGETI festival, ' . $winner->getTranslation('student_name', app()->getLocale()) . ', ' . $winner->getTranslation('project_title', app()->getLocale()) . ', academic project, student innovation')

{{-- Open Graph --}}
@section('og_type', 'article')
@section('og_title', $winner->getTranslation('student_name', app()->getLocale()) . ' - ' . $winner->getTranslation('project_title', app()->getLocale()))
@section('og_description', Str::limit($winner->getTranslation('project_description', app()->getLocale()), 200))
@section('og_image', $winner->project_image ? asset('storage/' . $winner->project_image) : asset('images/og-festival.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary_large_image')

@section('content')
{{-- contenido --}}

@section('title', $winner->getTranslation('student_name', app()->getLocale()) . ' - ' . __('DGETI Academic Festival'))

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="text-gray-500 hover:text-gray-700">
                        {{ __('Home') }}
                    </a>
                </li>
                <li><span class="text-gray-400">/</span></li>
                <li>
                    <a href="{{ route('festival.index', ['locale' => app()->getLocale()]) }}" class="text-gray-500 hover:text-gray-700">
                        {{ __('DGETI Academic Festival') }}
                    </a>
                </li>
                <li><span class="text-gray-400">/</span></li>
                <li class="text-purple-600 font-medium">
                    {{ $winner->getTranslation('student_name', app()->getLocale()) }}
                </li>
            </ol>
        </nav>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Contenido Principal -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Header con premio -->
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-8 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-4 py-2 bg-white bg-opacity-20 rounded-full text-sm font-semibold">
                                {{ $winner->category_name }}
                            </span>
                            <span class="text-4xl">
                                @if($winner->award_level === 'first_place') 🥇
                                @elseif($winner->award_level === 'second_place') 🥈
                                @elseif($winner->award_level === 'third_place') 🥉
                                @else 🎖️
                                @endif
                            </span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold mb-2">
                            {{ $winner->getTranslation('student_name', app()->getLocale()) }}
                        </h1>
                        <p class="text-purple-100 text-lg">
                            {{ $winner->award_level_name }} - {{ __('DGETI Academic Festival') }} {{ $winner->year }}
                        </p>
                    </div>

                    <!-- Foto del ganador -->
                    <div class="p-8">
                        @if($winner->photo)
                            <div class="mb-8 text-center">
                                <img src="{{ asset('storage/' . $winner->photo) }}" 
                                     alt="{{ $winner->getTranslation('student_name', app()->getLocale()) }}"
                                     class="w-48 h-48 rounded-full mx-auto object-cover border-8 border-purple-100 shadow-xl">
                            </div>
                        @endif

                        <!-- Información del estudiante -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold mb-4 flex items-center">
                                <span class="text-2xl mr-2">🏫</span>
                                {{ __('Academic Information') }}
                            </h2>
                            <div class="bg-gray-50 rounded-lg p-6 space-y-3">
                                <div class="flex items-start">
                                    <span class="font-semibold text-gray-700 w-32">{{ __('School') }}:</span>
                                    <span class="text-gray-900">{{ $winner->school }}</span>
                                </div>
                                @if($winner->state)
                                    <div class="flex items-start">
                                        <span class="font-semibold text-gray-700 w-32">{{ __('State') }}:</span>
                                        <span class="text-gray-900">{{ $winner->state }}</span>
                                    </div>
                                @endif
                                <div class="flex items-start">
                                    <span class="font-semibold text-gray-700 w-32">{{ __('Category') }}:</span>
                                    <span class="text-gray-900">{{ $winner->category_name }}</span>
                                </div>
                                <div class="flex items-start">
                                    <span class="font-semibold text-gray-700 w-32">{{ __('Award') }}:</span>
                                    <span class="font-bold text-purple-600">{{ $winner->award_level_name }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Proyecto -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold mb-4 flex items-center">
                                <span class="text-2xl mr-2">🔬</span>
                                {{ __('Research Project') }}
                            </h2>
                            <div class="prose max-w-none">
                                <h3 class="text-xl font-bold text-purple-600 mb-3">
                                    {{ $winner->getTranslation('project_title', app()->getLocale()) }}
                                </h3>
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                    {{ $winner->getTranslation('project_description', app()->getLocale()) }}
                                </p>
                            </div>
                        </div>

                        <!-- Botón volver -->
                        <div class="mt-8 pt-8 border-t">
                            <a href="{{ route('festival.index', ['locale' => app()->getLocale(), 'year' => $winner->year]) }}" 
                               class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                {{ __('Back to Festival') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Ganadores Relacionados -->
                @if($relatedWinners->isNotEmpty())
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                        <h3 class="text-xl font-bold mb-4">
                            {{ __('Related Winners') }}
                        </h3>
                        <div class="space-y-4">
                            @foreach($relatedWinners as $related)
                                <a href="{{ route('festival.show', ['locale' => app()->getLocale(), 'id' => $related->id]) }}" 
                                   class="block p-4 bg-gray-50 rounded-lg hover:bg-purple-50 transition">
                                    <div class="flex items-center gap-3 mb-2">
                                        @if($related->photo)
                                            <img src="{{ asset('storage/' . $related->photo) }}" 
                                                 alt="{{ $related->getTranslation('student_name', app()->getLocale()) }}"
                                                 class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-xl">👤</span>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-sm truncate">
                                                {{ $related->getTranslation('student_name', app()->getLocale()) }}
                                            </p>
                                            <p class="text-xs text-gray-600 truncate">
                                                {{ $related->school }}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="text-xs text-purple-600 font-medium line-clamp-2">
                                        {{ $related->getTranslation('project_title', app()->getLocale()) }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- CTA -->
                <div class="bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-xl font-bold mb-3">
                        {{ __('Join the Festival') }}
                    </h3>
                    <p class="text-purple-100 text-sm mb-4">
                        {{ __('Participate in the next DGETI Academic Festival and showcase your research') }}
                    </p>
                    <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" 
                       class="block text-center bg-white text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        {{ __('Learn More') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection