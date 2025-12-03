@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-purple-50 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        {{-- Card Principal --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6">
            {{-- Header --}}
            <div class="text-center">
                {{-- Ícono --}}
                <div class="mx-auto w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>

                {{-- Título --}}
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    {{ __('Create Account') }}
                </h2>
                <p class="text-gray-600">
                    {{ __('Join the ISS-LOOPS community') }}
                </p>
            </div>

            {{-- Mensaje de Desarrollo --}}
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-purple-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-purple-900">
                            {{ __('Authentication system in development') }}
                        </h3>
                        <p class="text-sm text-purple-700 mt-1">
                            Esta funcionalidad estará disponible próximamente. Por ahora, puedes explorar todo el contenido sin necesidad de registrarte.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Beneficios --}}
            <div class="space-y-3">
                <p class="text-sm font-medium text-gray-900">
                    {{ __('With your account you can:') }}
                </p>
                <ul class="space-y-2">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm text-gray-700">{{ __('Save your favorite articles') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm text-gray-700">{{ __('Personalize your reading experience') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm text-gray-700">{{ __('Receive personalized newsletters') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm text-gray-700">{{ __('Access exclusive content') }}</span>
                    </li>
                </ul>
            </div>

            {{-- Botón Volver --}}
            <div class="pt-4">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                   class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white text-sm font-medium rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>{{ __('Back to home') }}</span>
                </a>
            </div>

            {{-- ✅ CORRECCIÓN: Link a Login con locale --}}
            <div class="text-center pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-600">
                    {{ __('Already have an account?') }}
                    <a href="{{ route('login', ['locale' => app()->getLocale()]) }}"
                       class="font-medium text-purple-600 hover:text-purple-700 transition-colors">
                        {{ __('Login') }}
                    </a>
                </p>
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500">
                ISS-LOOPS - {{ __('Scientific Dissemination Magazine') }}
            </p>
        </div>
    </div>
</div>
@endsection