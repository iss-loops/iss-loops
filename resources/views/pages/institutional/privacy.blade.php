@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', __('Privacy Policy') . ' - ISS-LOOPS')
@section('description', __('Read our privacy policy to understand how we collect, use and protect your personal information. Your privacy is important to us.'))
@section('keywords', 'privacy policy, data protection, personal information, user privacy, GDPR, política de privacidad, protección de datos')
@section('robots', 'noindex, follow')

{{-- Open Graph --}}
@section('og_type', 'website')
@section('og_title', __('Privacy Policy') . ' - ISS-LOOPS')
@section('og_description', __('How we protect your personal information'))
@section('og_image', asset('images/og-default.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary')

@section('content')
{{-- El contenido existente --}}

@section('title', __('Privacy Policy') . ' - ISS-LOOPS')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ __('Privacy Policy') }}
            </h1>
            <p class="text-xl text-blue-100">
                {{ __('Last updated') }}: {{ __('November 28, 2024') }}
            </p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-xl shadow-lg p-8 prose prose-lg max-w-none">
            <h2>{{ __('Introduction') }}</h2>
            <p>
                {{ __('At ISS-LOOPS, we are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website.') }}
            </p>

            <h2>{{ __('Information We Collect') }}</h2>
            <h3>{{ __('Personal Data') }}</h3>
            <p>
                {{ __('We may collect personal information that you voluntarily provide to us when you:') }}
            </p>
            <ul>
                <li>{{ __('Register on the website') }}</li>
                <li>{{ __('Subscribe to our newsletter') }}</li>
                <li>{{ __('Contact us through our contact form') }}</li>
                <li>{{ __('Save articles as favorites') }}</li>
            </ul>

            <p>{{ __('This information may include:') }}</p>
            <ul>
                <li>{{ __('Name') }}</li>
                <li>{{ __('Email address') }}</li>
                <li>{{ __('Language preferences') }}</li>
                <li>{{ __('Content preferences') }}</li>
            </ul>

            <h3>{{ __('Automatically Collected Information') }}</h3>
            <p>
                {{ __('When you visit our website, we may automatically collect certain information about your device, including:') }}
            </p>
            <ul>
                <li>{{ __('IP address') }}</li>
                <li>{{ __('Browser type') }}</li>
                <li>{{ __('Operating system') }}</li>
                <li>{{ __('Access times') }}</li>
                <li>{{ __('Pages viewed') }}</li>
            </ul>

            <h2>{{ __('How We Use Your Information') }}</h2>
            <p>{{ __('We use the information we collect to:') }}</p>
            <ul>
                <li>{{ __('Provide and maintain our services') }}</li>
                <li>{{ __('Send you newsletters and updates (if you subscribed)') }}</li>
                <li>{{ __('Respond to your comments and questions') }}</li>
                <li>{{ __('Improve our website and user experience') }}</li>
                <li>{{ __('Analyze usage patterns and trends') }}</li>
            </ul>

            <h2>{{ __('Cookies') }}</h2>
            <p>
                {{ __('We use cookies and similar tracking technologies to track activity on our website and store certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.') }}
            </p>

            <h2>{{ __('Data Security') }}</h2>
            <p>
                {{ __('We implement appropriate technical and organizational security measures to protect your personal information. However, no method of transmission over the Internet is 100% secure.') }}
            </p>

            <h2>{{ __('Your Rights') }}</h2>
            <p>{{ __('You have the right to:') }}</p>
            <ul>
                <li>{{ __('Access your personal data') }}</li>
                <li>{{ __('Correct inaccurate data') }}</li>
                <li>{{ __('Request deletion of your data') }}</li>
                <li>{{ __('Unsubscribe from our newsletter at any time') }}</li>
                <li>{{ __('Object to processing of your data') }}</li>
            </ul>

            <h2>{{ __('Contact Us') }}</h2>
            <p>
                {{ __('If you have questions about this Privacy Policy, please contact us at:') }}
            </p>
            <p>
                <strong>Email:</strong> <a href="mailto:contacto@iss-loops.com">contacto@iss-loops.com</a>
            </p>

            <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-sm text-blue-800 mb-0">
                    {{ __('This privacy policy is subject to change. We will notify you of any changes by posting the new policy on this page.') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection 