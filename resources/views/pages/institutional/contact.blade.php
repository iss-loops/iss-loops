@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', __('Contact') . ' - ISS-LOOPS')
@section('description', __('Get in touch with ISS-LOOPS editorial team. Send us your questions, suggestions or collaboration proposals. We are here to help you.'))
@section('keywords', 'contact ISS-LOOPS, editorial team, science magazine contact, collaboration, feedback, contacto, equipo editorial')
@section('robots', 'noindex, follow')

{{-- Open Graph --}}
@section('og_type', 'website')
@section('og_title', __('Contact') . ' - ISS-LOOPS')
@section('og_description', __('Get in touch with our editorial team'))
@section('og_image', asset('images/og-default.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary')

@section('content')
{{-- El contenido existente --}}

@section('title', __('Contact') . ' - ISS-LOOPS')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ __('Contact Us') }}
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl">
                {{ __('We would love to hear from you. Send us a message and we will respond as soon as possible.') }}
            </p>
        </div>
    </div>

    {{-- Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid lg:grid-cols-3 gap-12">
            {{-- Información de Contacto --}}
            <div class="lg:col-span-1 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Get in Touch') }}</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('Have a question about our content? Want to collaborate? Or just want to say hello? Fill out the form and we will get back to you.') }}
                    </p>
                </div>

                {{-- Contact Info Cards --}}
                <div class="space-y-4">
                    {{-- Email --}}
                    <div class="flex items-start space-x-4 p-4 bg-white rounded-lg shadow-sm">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ __('Email') }}</h3>
                            <a href="mailto:contacto@iss-loops.com" class="text-blue-600 hover:text-blue-700">
                                contacto@iss-loops.com
                            </a>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    <div class="flex items-start space-x-4 p-4 bg-white rounded-lg shadow-sm">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ __('Social Media') }}</h3>
                            <p class="text-gray-600">{{ __('Follow us on our networks') }}</p>
                            <div class="flex gap-2 mt-2">
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Response Time --}}
                    <div class="flex items-start space-x-4 p-4 bg-white rounded-lg shadow-sm">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ __('Response Time') }}</h3>
                            <p class="text-gray-600">{{ __('We usually respond within 24-48 hours') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Formulario de Contacto --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Send us a Message') }}</h2>

                    <form id="contactForm" x-data="contactForm()" @submit.prevent="submitForm">
                        <div class="space-y-6">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Full Name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       x-model="formData.name"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                       :class="{ 'border-red-500': errors.name }"
                                       placeholder="{{ __('Enter your full name') }}">
                                <p x-show="errors.name" x-text="errors.name" class="mt-1 text-sm text-red-500"></p>
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Email') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       x-model="formData.email"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                       :class="{ 'border-red-500': errors.email }"
                                       placeholder="{{ __('your@email.com') }}">
                                <p x-show="errors.email" x-text="errors.email" class="mt-1 text-sm text-red-500"></p>
                            </div>

                            {{-- Subject --}}
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Subject') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="subject" 
                                       x-model="formData.subject"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                       :class="{ 'border-red-500': errors.subject }"
                                       placeholder="{{ __('What is your message about?') }}">
                                <p x-show="errors.subject" x-text="errors.subject" class="mt-1 text-sm text-red-500"></p>
                            </div>

                            {{-- Message --}}
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Message') }} <span class="text-red-500">*</span>
                                </label>
                                <textarea id="message" 
                                          x-model="formData.message"
                                          rows="6"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                                          :class="{ 'border-red-500': errors.message }"
                                          placeholder="{{ __('Write your message here...') }}"></textarea>
                                <div class="flex justify-between mt-1">
                                    <p x-show="errors.message" x-text="errors.message" class="text-sm text-red-500"></p>
                                    <p class="text-sm text-gray-500" x-text="formData.message.length + '/5000'"></p>
                                </div>
                            </div>

                            {{-- Success Message --}}
                            <div x-show="successMessage" 
                                 x-transition
                                 class="p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-green-700" x-text="successMessage"></p>
                                </div>
                            </div>

                            {{-- Error Message --}}
                            <div x-show="errorMessage" 
                                 x-transition
                                 class="p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-red-700" x-text="errorMessage"></p>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" 
                                    :disabled="loading"
                                    class="w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center">
                                <span x-show="!loading">{{ __('Send Message') }}</span>
                                <span x-show="loading" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ __('Sending...') }}
                                </span>
                            </button>

                            <p class="text-sm text-gray-500 text-center">
                                {{ __('By sending this form, you agree to our') }}
                                <a href="{{ route('privacy', ['locale' => app()->getLocale()]) }}" class="text-blue-600 hover:text-blue-700">
                                    {{ __('Privacy Policy') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function contactForm() {
    return {
        loading: false,
        successMessage: '',
        errorMessage: '',
        formData: {
            name: '',
            email: '',
            subject: '',
            message: ''
        },
        errors: {},

        async submitForm() {
            this.loading = true;
            this.errors = {};
            this.successMessage = '';
            this.errorMessage = '';

            try {
                const response = await fetch('{{ route("contact.send", ["locale" => app()->getLocale()]) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.formData)
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    this.successMessage = data.message;
                    // Reset form
                    this.formData = {
                        name: '',
                        email: '',
                        subject: '',
                        message: ''
                    };
                    // Auto-hide message after 5 seconds
                    setTimeout(() => {
                        this.successMessage = '';
                    }, 5000);
                } else if (data.status === 'error' && data.errors) {
                    this.errors = data.errors;
                } else {
                    this.errorMessage = data.message || '{{ __("An error occurred") }}';
                }
            } catch (error) {
                this.errorMessage = '{{ __("An error occurred while sending your message. Please try again.") }}';
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
@endsection