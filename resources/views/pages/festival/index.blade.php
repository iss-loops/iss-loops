@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', __('DGETI Festival') . ' - ' . __('Featured Winners') . ' - ISS-LOOPS')
@section('description', __('Discover the academic excellence of DGETI Festival 2025 winners. Exceptional projects in science, technology, engineering and innovation by talented students.'))
@section('keywords', 'DGETI festival, academic projects, student science, innovation, engineering projects, DGETI 2025, festival académico, proyectos estudiantiles')

{{-- Open Graph --}}
@section('og_type', 'website')
@section('og_title', __('DGETI Festival 2025') . ' - ' . __('Featured Winners'))
@section('og_description', __('Exceptional academic projects by talented DGETI students'))
@section('og_image', asset('images/og-festival.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary_large_image')
@section('twitter_title', __('DGETI Festival 2025'))
@section('twitter_description', __('Discover exceptional student projects'))

@section('content')
{{-- El contenido existente --}}

@section('title', __('DGETI Academic Festival') . ' - ISS-LOOPS')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    {{ __('DGETI Academic Festival') }}
                </h1>
                <p class="text-xl text-purple-100 max-w-3xl mx-auto">
                    {{ __('Celebrating scientific innovation and academic excellence from DGETI students across Mexico') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Filtro de Año -->
                <div class="flex items-center gap-3">
                    <label class="text-gray-700 font-medium">{{ __('Year') }}:</label>
                    <select onchange="window.location.href='{{ route('festival.index', ['locale' => app()->getLocale()]) }}?year=' + this.value + '&category={{ $category }}'"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                        @foreach($availableYears as $availableYear)
                            <option value="{{ $availableYear }}" {{ $year == $availableYear ? 'selected' : '' }}>
                                {{ $availableYear }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro de Categoría -->
                <div class="flex items-center gap-3">
                    <label class="text-gray-700 font-medium">{{ __('Category') }}:</label>
                    <select onchange="window.location.href='{{ route('festival.index', ['locale' => app()->getLocale()]) }}?year={{ $year }}&category=' + this.value"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                        <option value="">{{ __('All Categories') }}</option>
                        @foreach($categories as $key => $name)
                            <option value="{{ $key }}" {{ $category == $key ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Contador -->
                <div class="text-gray-600">
                    <span class="font-bold text-purple-600">{{ $winners->count() }}</span>
                    {{ __('winners found') }}
                </div>
            </div>
        </div>

        <!-- Ganadores Destacados -->
        @if($featuredWinners->isNotEmpty() && !$category)
            <div class="mb-12">
                <h2 class="text-3xl font-bold mb-6 text-center">
                    {{ __('Featured Winners') }} 🏆
                </h2>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($featuredWinners as $featured)
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border-2 border-yellow-400 rounded-xl p-6 shadow-lg transform hover:scale-105 transition">
                            <div class="text-center mb-4">
                                @if($featured->photo)
                                    <img src="{{ asset('storage/' . $featured->photo) }}" 
                                         alt="{{ $featured->getTranslation('student_name', app()->getLocale()) }}"
                                         class="w-24 h-24 rounded-full mx-auto object-cover border-4 border-yellow-400">
                                @else
                                    <div class="w-24 h-24 rounded-full mx-auto bg-yellow-400 flex items-center justify-center">
                                        <span class="text-4xl">🏆</span>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-center mb-2">
                                {{ $featured->getTranslation('student_name', app()->getLocale()) }}
                            </h3>
                            <p class="text-center text-sm text-gray-600 mb-3">
                                {{ $featured->school }}
                            </p>
                            <div class="bg-white rounded-lg p-3 mb-3">
                                <p class="font-semibold text-purple-600 text-sm mb-1">
                                    {{ $featured->getTranslation('project_title', app()->getLocale()) }}
                                </p>
                                <p class="text-xs text-gray-600 line-clamp-2">
                                    {{ $featured->getTranslation('project_description', app()->getLocale()) }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-medium rounded-full">
                                    {{ $featured->category_name }}
                                </span>
                                <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full">
                                    {{ $featured->award_level_name }}
                                </span>
                            </div>
                            <a href="{{ route('festival.show', ['locale' => app()->getLocale(), 'id' => $featured->id]) }}" 
                               class="block mt-4 text-center bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition">
                                {{ __('View Details') }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Todos los Ganadores -->
        <div>
            <h2 class="text-3xl font-bold mb-6">
                {{ __('All Winners') }} {{ $year }}
            </h2>

            @if($winners->isEmpty())
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">
                        {{ __('No winners found') }}
                    </h3>
                    <p class="text-gray-600">
                        {{ __('Try adjusting your filters') }}
                    </p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($winners as $winner)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden">
                            <!-- Badge de Premio -->
                            <div class="bg-{{ $winner->award_color }}-100 px-4 py-2 flex items-center justify-between">
                                <span class="text-{{ $winner->award_color }}-800 font-bold text-sm">
                                    {{ $winner->award_level_name }}
                                </span>
                                <span class="text-2xl">
                                    @if($winner->award_level === 'first_place') 🥇
                                    @elseif($winner->award_level === 'second_place') 🥈
                                    @elseif($winner->award_level === 'third_place') 🥉
                                    @else 🎖️
                                    @endif
                                </span>
                            </div>

                            <div class="p-6">
                                <!-- Foto -->
                                <div class="text-center mb-4">
                                    @if($winner->photo)
                                        <img src="{{ asset('storage/' . $winner->photo) }}" 
                                             alt="{{ $winner->getTranslation('student_name', app()->getLocale()) }}"
                                             class="w-20 h-20 rounded-full mx-auto object-cover border-4 border-gray-200">
                                    @else
                                        <div class="w-20 h-20 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                            <span class="text-3xl">👤</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Nombre -->
                                <h3 class="text-lg font-bold text-center mb-2">
                                    {{ $winner->getTranslation('student_name', app()->getLocale()) }}
                                </h3>

                                <!-- Escuela -->
                                <p class="text-center text-sm text-gray-600 mb-3">
                                    {{ $winner->school }}
                                    @if($winner->state)
                                        <br>{{ $winner->state }}
                                    @endif
                                </p>

                                <!-- Proyecto -->
                                <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                    <p class="font-semibold text-purple-600 text-sm mb-1">
                                        {{ $winner->getTranslation('project_title', app()->getLocale()) }}
                                    </p>
                                    <p class="text-xs text-gray-600 line-clamp-3">
                                        {{ $winner->getTranslation('project_description', app()->getLocale()) }}
                                    </p>
                                </div>

                                <!-- Categoría -->
                                <div class="flex items-center justify-center mb-4">
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-medium rounded-full">
                                        {{ $winner->category_name }}
                                    </span>
                                </div>

                                <!-- Botón -->
                                <a href="{{ route('festival.show', ['locale' => app()->getLocale(), 'id' => $winner->id]) }}" 
                                   class="block text-center bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition">
                                    {{ __('View Details') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection