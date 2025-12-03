@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', $game->getTranslation('title', app()->getLocale()) . ' - ' . __('Games') . ' - ISS-LOOPS')
@section('description', Str::limit($game->getTranslation('description', app()->getLocale()), 155))
@section('keywords', 'physics game, science simulation, interactive learning, ' . $game->type . ', educational game, ' . $game->getTranslation('title', app()->getLocale()))

{{-- Open Graph --}}
@section('og_type', 'website')
@section('og_title', $game->getTranslation('title', app()->getLocale()) . ' - ISS-LOOPS')
@section('og_description', $game->getTranslation('description', app()->getLocale()))
@section('og_image', asset('images/og-games.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary_large_image')

@section('content')
{{-- contenido --}}

@section('title', $game->getTranslation('title', app()->getLocale()) . ' - ' . __('Games'))

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    
    {{-- Breadcrumb --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="hover:text-purple-600 transition">
                    {{ __('Home') }}
                </a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <a href="{{ route('games.index', ['locale' => app()->getLocale()]) }}" class="hover:text-purple-600 transition">
                    {{ __('Games') }}
                </a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-900 font-medium">
                    {{ $game->getTranslation('title', app()->getLocale()) }}
                </span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Main Game Area --}}
            <div class="lg:col-span-2">
                {{-- Game Header --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    @php
                                        $typeColor = match($game->type) {
                                            'physics' => 'bg-blue-100 text-blue-700',
                                            'math' => 'bg-purple-100 text-purple-700',
                                            'biology' => 'bg-green-100 text-green-700',
                                            'chemistry' => 'bg-orange-100 text-orange-700',
                                            default => 'bg-gray-100 text-gray-700'
                                        };
                                        $diffColor = match($game->difficulty) {
                                            'easy' => 'bg-green-100 text-green-700',
                                            'medium' => 'bg-yellow-100 text-yellow-700',
                                            'hard' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700'
                                        };
                                    @endphp
                                    <span class="{{ $typeColor }} px-3 py-1 rounded-full text-sm font-medium">
                                        {{ __(ucfirst($game->type)) }}
                                    </span>
                                    <span class="{{ $diffColor }} px-3 py-1 rounded-full text-sm font-medium">
                                        {{ __(ucfirst($game->difficulty)) }}
                                    </span>
                                </div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                    {{ $game->getTranslation('title', app()->getLocale()) }}
                                </h1>
                                <p class="text-gray-600">
                                    {{ $game->getTranslation('description', app()->getLocale()) }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-6 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $game->estimated_time }} {{ __('minutes') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $game->play_count }} {{ __('plays') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Game Canvas Area --}}
                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 p-8">
                        <div id="game-container" class="bg-white rounded-xl shadow-inner overflow-hidden">
                            <canvas id="game-canvas" class="w-full" width="800" height="600"></canvas>
                        </div>
                        
                        {{-- Game Controls --}}
                        <div id="game-controls" class="mt-6 bg-white rounded-xl p-6 shadow-lg">
                            {{-- Los controles específicos se cargarán desde el JS del juego --}}
                        </div>
                    </div>
                </div>

                {{-- Instructions Section --}}
                @if($game->getTranslation('instructions', app()->getLocale()))
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('How to Play') }}
                    </h2>
                    <div class="prose prose-purple max-w-none">
                        @php
                            $instructions = $game->getTranslation('instructions', app()->getLocale());
                            $instructionLines = explode("\n", $instructions);
                        @endphp
                        <ol class="space-y-2">
                            @foreach($instructionLines as $line)
                                @if(trim($line))
                                <li class="text-gray-700">{{ trim($line, '0123456789. ') }}</li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
                @endif

                {{-- Learning Objectives --}}
                @if($game->getTranslation('learning_objectives', app()->getLocale()))
                <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl p-6 border border-purple-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        {{ __('Learning Objectives') }}
                    </h2>
                    <ul class="space-y-3">
                        @foreach($game->getTranslation('learning_objectives', app()->getLocale()) as $objective)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">{{ $objective }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1">
                {{-- Quick Actions --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 sticky top-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">{{ __('Quick Actions') }}</h3>
                    <div class="space-y-3">
                        <button id="reset-game" class="w-full px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            {{ __('Reset') }}
                        </button>
                        
                        <button id="fullscreen-toggle" class="w-full px-4 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                            </svg>
                            {{ __('Fullscreen') }}
                        </button>

                        <a href="{{ route('games.index', ['locale' => app()->getLocale()]) }}" 
                           class="block w-full px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-center">
                            {{ __('Back to Games') }}
                        </a>
                    </div>
                </div>

                {{-- Related Games --}}
                @if($relatedGames->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">{{ __('Related Games') }}</h3>
                    <div class="space-y-4">
                        @foreach($relatedGames as $related)
                        <a href="{{ route('games.show', ['locale' => app()->getLocale(), 'slug' => $related->slug]) }}" 
                           class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition group">
                            <div class="flex items-center gap-2 mb-2">
                                @php
                                    $typeColor = match($related->type) {
                                        'physics' => 'bg-blue-100 text-blue-700',
                                        'math' => 'bg-purple-100 text-purple-700',
                                        'biology' => 'bg-green-100 text-green-700',
                                        'chemistry' => 'bg-orange-100 text-orange-700',
                                        default => 'bg-gray-100 text-gray-700'
                                    };
                                @endphp
                                <span class="{{ $typeColor }} px-2 py-1 rounded-full text-xs font-medium">
                                    {{ __(ucfirst($related->type)) }}
                                </span>
                            </div>
                            <h4 class="font-semibold text-gray-900 group-hover:text-purple-600 transition line-clamp-1">
                                {{ $related->getTranslation('title', app()->getLocale()) }}
                            </h4>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                                {{ $related->getTranslation('description', app()->getLocale()) }}
                            </p>
                            <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $related->estimated_time }} {{ __('min') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    </svg>
                                    {{ $related->play_count }}
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Load Game Script --}}
<script src="{{ asset('js/games/' . $game->game_file . '.js') }}"></script>

<script>
// Reset Game
document.getElementById('reset-game')?.addEventListener('click', function() {
    if (typeof resetGame === 'function') {
        resetGame();
    }
});

// Fullscreen Toggle
document.getElementById('fullscreen-toggle')?.addEventListener('click', function() {
    const container = document.getElementById('game-container');
    if (!document.fullscreenElement) {
        container.requestFullscreen().catch(err => {
            console.log('Error attempting to enable fullscreen:', err);
        });
    } else {
        document.exitFullscreen();
    }
});
</script>
@endsection