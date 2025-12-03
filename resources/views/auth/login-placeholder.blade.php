@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        {{-- Card Principal --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6">
            {{-- Header --}}
            <div class="text-center">
                {{-- Ícono --}}
                <div class="mx-auto w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                {{-- Título --}}
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    {{ __('Login') }}
                </h2>
                <p class="text-gray-600">
                    {{ __('Access your account') }}
                </p>
            </div>

            {{-- Mensaje de Desarrollo --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-blue-900">
                            {{ __('Authentication system in development') }}
                        </h3>
                        <p class="text-sm text-blue-700 mt-1">
                            Esta funcionalidad estará disponible próximamente. Por ahora, puedes explorar el contenido sin necesidad de iniciar sesión.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Botón Volver --}}
            <div class="pt-4">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                   class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>{{ __('Back to home') }}</span>
                </a>
            </div>

            {{-- ✅ CORRECCIÓN: Link a Registro con locale --}}
            <div class="text-center pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-600">
                    {{ __("Don't have an account?") }}
                    <a href="{{ route('register', ['locale' => app()->getLocale()]) }}"
                       class="font-medium text-blue-600 hover:text-blue-700 transition-colors">
                        {{ __('Create Account') }}
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