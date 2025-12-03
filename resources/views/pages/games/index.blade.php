@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', __('Interactive Games') . ' - ' . __('Educational Simulations') . ' - ISS-LOOPS')
@section('description', __('Learn physics through fun and interactive simulations. Explore pendulums, free fall, vectors, and projectile motion with hands-on educational games.'))
@section('keywords', 'physics games, educational simulations, interactive learning, pendulum simulator, free fall, vectors, projectile motion, science games, física interactiva, juegos educativos')

{{-- Open Graph --}}
@section('og_type', 'website')
@section('og_title', __('Interactive Physics Games') . ' - ISS-LOOPS')
@section('og_description', __('Learn physics through fun interactive simulations and games'))
@section('og_image', asset('images/og-games.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary_large_image')
@section('twitter_title', __('Educational Physics Games'))
@section('twitter_description', __('Interactive simulations to learn physics'))
@section('twitter_image', asset('images/twitter-games.jpg'))

@section('content')
{{-- El contenido existente --}}

@section('title', __('Games') . ' - ISS-LOOPS')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 via-white to-blue-50">
    
    {{-- Hero Section --}}
    <div class="relative bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 text-white py-20 overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-6 backdrop-blur-sm">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    {{ __('Interactive Games') }}
                </h1>
                <p class="text-xl md:text-2xl text-purple-100 max-w-3xl mx-auto mb-8">
                    {{ __('Learn physics through fun and interactive simulations') }}
                </p>
                
                {{-- Stats --}}
                <div class="flex justify-center gap-8 mt-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $games->total() }}</div>
                        <div class="text-purple-200 text-sm">{{ __('Games') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $types->sum() }}</div>
                        <div class="text-purple-200 text-sm">{{ __('Simulations') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $games->sum('play_count') }}</div>
                        <div class="text-purple-200 text-sm">{{ __('Times Played') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Search and Filters Section --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
            <form method="GET" action="{{ route('games.index', ['locale' => app()->getLocale()]) }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    {{-- Search --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Search') }}
                        </label>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="{{ __('Search games...') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    {{-- Type Filter --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Type') }}
                        </label>
                        <select name="type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">{{ __('All Types') }}</option>
                            <option value="physics" {{ request('type') == 'physics' ? 'selected' : '' }}>{{ __('Physics') }}</option>
                            <option value="math" {{ request('type') == 'math' ? 'selected' : '' }}>{{ __('Mathematics') }}</option>
                            <option value="biology" {{ request('type') == 'biology' ? 'selected' : '' }}>{{ __('Biology') }}</option>
                            <option value="chemistry" {{ request('type') == 'chemistry' ? 'selected' : '' }}>{{ __('Chemistry') }}</option>
                        </select>
                    </div>

                    {{-- Difficulty Filter --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Difficulty') }}
                        </label>
                        <select name="difficulty" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">{{ __('All Levels') }}</option>
                            <option value="easy" {{ request('difficulty') == 'easy' ? 'selected' : '' }}>{{ __('Easy') }}</option>
                            <option value="medium" {{ request('difficulty') == 'medium' ? 'selected' : '' }}>{{ __('Medium') }}</option>
                            <option value="hard" {{ request('difficulty') == 'hard' ? 'selected' : '' }}>{{ __('Hard') }}</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium">
                        {{ __('Apply Filters') }}
                    </button>
                    @if(request('search') || request('type') || request('difficulty'))
                    <a href="{{ route('games.index', ['locale' => app()->getLocale()]) }}" 
                       class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                        {{ __('Clear') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Featured Games --}}
    @if($featuredGames->count() > 0 && !request()->hasAny(['search', 'type', 'difficulty']))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ __('Featured Games') }}</h2>
                <p class="text-gray-600 mt-2">{{ __('Most popular simulations') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($featuredGames as $game)
            <a href="{{ route('games.show', ['locale' => app()->getLocale(), 'slug' => $game->slug]) }}" 
               class="group relative bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                
                <div class="absolute top-4 right-4 z-10">
                    <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        {{ __('Featured') }}
                    </span>
                </div>

                <div class="relative p-8 text-white">
                    <div class="flex items-center gap-2 mb-4">
                        @php
                            $typeColor = match($game->type) {
                                'physics' => 'bg-blue-400',
                                'math' => 'bg-purple-400',
                                'biology' => 'bg-green-400',
                                'chemistry' => 'bg-orange-400',
                                default => 'bg-gray-400'
                            };
                        @endphp
                        <span class="{{ $typeColor }} px-3 py-1 rounded-full text-sm font-medium">
                            {{ __(ucfirst($game->type)) }}
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold mb-3 group-hover:text-yellow-300 transition">
                        {{ $game->getTranslation('title', app()->getLocale()) }}
                    </h3>
                    
                    <p class="text-purple-100 mb-6 line-clamp-2">
                        {{ $game->getTranslation('description', app()->getLocale()) }}
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4 text-sm">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $game->estimated_time }} {{ __('min') }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $game->play_count }}
                            </span>
                        </div>
                        
                        <span class="inline-flex items-center gap-2 text-white font-medium group-hover:gap-3 transition-all">
                            {{ __('Play Now') }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- All Games Grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">
            @if(request('search'))
                {{ __('Search Results') }}
            @elseif(request('type') || request('difficulty'))
                {{ __('Filtered Games') }}
            @else
                {{ __('All Games') }}
            @endif
        </h2>

        @if($games->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach($games as $game)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100">
                <div class="relative bg-gradient-to-br from-gray-100 to-gray-200 h-48 flex items-center justify-center">
                    @php
                        $iconColor = match($game->type) {
                            'physics' => 'text-blue-500',
                            'math' => 'text-purple-500',
                            'biology' => 'text-green-500',
                            'chemistry' => 'text-orange-500',
                            default => 'text-gray-500'
                        };
                    @endphp
                    <svg class="w-24 h-24 {{ $iconColor }} opacity-50 group-hover:opacity-70 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>

                    <div class="absolute top-3 left-3 flex gap-2">
                        @php
                            $typeColor = match($game->type) {
                                'physics' => 'bg-blue-100 text-blue-700',
                                'math' => 'bg-purple-100 text-purple-700',
                                'biology' => 'bg-green-100 text-green-700',
                                'chemistry' => 'bg-orange-100 text-orange-700',
                                default => 'bg-gray-100 text-gray-700'
                            };
                        @endphp
                        <span class="{{ $typeColor }} px-2 py-1 rounded-full text-xs font-medium">
                            {{ __(ucfirst($game->type)) }}
                        </span>
                    </div>

                    <div class="absolute top-3 right-3">
                        @php
                            $diffColor = match($game->difficulty) {
                                'easy' => 'bg-green-100 text-green-700',
                                'medium' => 'bg-yellow-100 text-yellow-700',
                                'hard' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700'
                            };
                        @endphp
                        <span class="{{ $diffColor }} px-2 py-1 rounded-full text-xs font-medium">
                            {{ __(ucfirst($game->difficulty)) }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition line-clamp-1">
                        {{ $game->getTranslation('title', app()->getLocale()) }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $game->getTranslation('description', app()->getLocale()) }}
                    </p>

                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $game->estimated_time }} {{ __('min') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $game->play_count }}
                        </span>
                    </div>

                    <a href="{{ route('games.show', ['locale' => app()->getLocale(), 'slug' => $game->slug]) }}" 
                       class="block w-full text-center px-4 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition font-medium group-hover:shadow-lg">
                        {{ __('Play Game') }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $games->links() }}
        </div>

        @else
        <div class="text-center py-16">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('No games found') }}</h3>
            <p class="text-gray-600 mb-6">{{ __('Try adjusting your filters or search terms') }}</p>
            <a href="{{ route('games.index', ['locale' => app()->getLocale()]) }}" 
               class="inline-block px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                {{ __('View All Games') }}
            </a>
        </div>
        @endif
    </div>

</div>
@endsection