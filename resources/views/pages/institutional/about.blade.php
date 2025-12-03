@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', __('About Us') . ' - ' . __('Our Mission') . ' - ISS-LOOPS')
@section('description', __('ISS-LOOPS is a bilingual scientific communication magazine dedicated to making science accessible to everyone. Learn about our mission, vision and commitment to scientific education.'))
@section('keywords', 'about ISS-LOOPS, scientific communication, science education, bilingual magazine, our mission, science accessibility, divulgación científica, educación científica')

{{-- Open Graph --}}
@section('og_type', 'website')
@section('og_title', __('About ISS-LOOPS') . ' - ' . __('Making Science Accessible'))
@section('og_description', __('Bilingual scientific magazine dedicated to science education and communication'))
@section('og_image', asset('images/og-about.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary')
@section('twitter_title', __('About ISS-LOOPS'))
@section('twitter_description', __('Making science accessible to everyone'))

@section('content')
{{-- El contenido existente --}}

@section('title', __('About Us') . ' - ISS-LOOPS')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                {{ __('About ISS-LOOPS') }}
            </h1>
            <p class="text-xl text-blue-100 max-w-3xl">
                {{ __('Making science accessible to everyone') }}
            </p>
        </div>
    </div>

    {{-- Misión y Visión --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 gap-12">
            {{-- Misión --}}
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold mb-4 text-gray-900">{{ __('Our Mission') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('To democratize scientific knowledge by providing accessible, accurate, and engaging content in multiple languages. We believe everyone should have the opportunity to understand and appreciate the wonders of science.') }}
                </p>
            </div>

            {{-- Visión --}}
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold mb-4 text-gray-900">{{ __('Our Vision') }}</h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('To become the leading bilingual platform for scientific communication, inspiring curiosity and fostering a global community of science enthusiasts and learners.') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Qué es ISS-LOOPS --}}
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-8 text-center text-gray-900">
                {{ __('What is ISS-LOOPS?') }}
            </h2>
            <div class="max-w-3xl mx-auto text-gray-600 space-y-4">
                <p>
                    {{ __('ISS-LOOPS is a bilingual scientific communication magazine designed to make science accessible to students and curious minds. Our name represents the continuous cycle of knowledge - like loops in the International Space Station, science is an ongoing journey of discovery.') }}
                </p>
                <p>
                    {{ __('We cover a wide range of topics including quantum computing, space exploration, nuclear fusion, biology, medicine, and emerging technologies. Each article is carefully researched and written in both Spanish and English to reach a broader audience.') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Objetivos --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold mb-12 text-center text-gray-900">{{ __('Our Goals') }}</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">🎓</span>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">{{ __('Educate') }}</h3>
                <p class="text-gray-600">
                    {{ __('Provide accurate and understandable scientific content for all education levels') }}
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">✨</span>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">{{ __('Inspire') }}</h3>
                <p class="text-gray-600">
                    {{ __('Spark curiosity and passion for science in readers of all ages') }}
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">🌍</span>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900">{{ __('Connect') }}</h3>
                <p class="text-gray-600">
                    {{ __('Build a global community of science enthusiasts and learners') }}
                </p>
            </div>
        </div>
    </div>

    {{-- CTA Newsletter --}}
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">{{ __('Join Our Community') }}</h2>
            <p class="text-xl mb-8 text-blue-100">
                {{ __('Subscribe to receive the latest articles and stay updated on scientific breakthroughs') }}
            </p>
            @auth
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#newsletter"
                    class="inline-block px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                    {{ __('Subscribe Now') }}
                </a>
            @else
                <a href="{{ route('register', ['locale' => app()->getLocale()]) }}"
                    class="inline-block px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                    {{ __('Create Account') }}
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection