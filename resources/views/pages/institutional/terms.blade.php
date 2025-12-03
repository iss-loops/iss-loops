@extends('layouts.app')

{{-- SEO Meta Tags --}}
@section('title', __('Terms and Conditions') . ' - ISS-LOOPS')
@section('description', __('Read our terms and conditions to understand the rules for using ISS-LOOPS. By using our platform, you agree to these terms.'))
@section('keywords', 'terms and conditions, terms of use, user agreement, legal terms, términos y condiciones, términos de uso')
@section('robots', 'noindex, follow')

{{-- Open Graph --}}
@section('og_type', 'website')
@section('og_title', __('Terms and Conditions') . ' - ISS-LOOPS')
@section('og_description', __('Legal terms for using our platform'))
@section('og_image', asset('images/og-default.jpg'))

{{-- Twitter Card --}}
@section('twitter_card', 'summary')

@section('content')
{{-- El contenido existente --}}
@section('title', __('Terms and Conditions') . ' - ISS-LOOPS')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ __('Terms and Conditions') }}
            </h1>
            <p class="text-xl text-indigo-100">
                {{ __('Last updated') }}: {{ __('November 28, 2024') }}
            </p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-xl shadow-lg p-8 prose prose-lg max-w-none">
            <h2>{{ __('Acceptance of Terms') }}</h2>
            <p>
                {{ __('By accessing and using ISS-LOOPS, you accept and agree to be bound by the terms and provision of this agreement.') }}
            </p>

            <h2>{{ __('Use of Content') }}</h2>
            <p>
                {{ __('The content on ISS-LOOPS, including articles, images, videos, and other materials, is provided for informational and educational purposes only.') }}
            </p>

            <h3>{{ __('Permitted Uses') }}</h3>
            <ul>
                <li>{{ __('Read and access content for personal use') }}</li>
                <li>{{ __('Share articles on social media') }}</li>
                <li>{{ __('Subscribe to our newsletter') }}</li>
                <li>{{ __('Create a user account') }}</li>
            </ul>

            <h3>{{ __('Prohibited Uses') }}</h3>
            <ul>
                <li>{{ __('Reproduce content without permission') }}</li>
                <li>{{ __('Use content for commercial purposes without authorization') }}</li>
                <li>{{ __('Modify or create derivative works') }}</li>
                <li>{{ __('Remove copyright notices or attributions') }}</li>
            </ul>

            <h2>{{ __('User Accounts') }}</h2>
            <p>{{ __('When you create an account, you agree to:') }}</p>
            <ul>
                <li>{{ __('Provide accurate and complete information') }}</li>
                <li>{{ __('Maintain the security of your password') }}</li>
                <li>{{ __('Accept responsibility for all activities under your account') }}</li>
                <li>{{ __('Notify us immediately of any unauthorized use') }}</li>
            </ul>

            <h2>{{ __('Intellectual Property') }}</h2>
            <p>
                {{ __('All content on ISS-LOOPS, including text, graphics, logos, images, and software, is the property of ISS-LOOPS or its content suppliers and is protected by copyright laws.') }}
            </p>

            <h2>{{ __('User-Generated Content') }}</h2>
            <p>
                {{ __('By submitting content through our contact form or other features, you grant ISS-LOOPS a non-exclusive, royalty-free license to use, reproduce, and publish such content.') }}
            </p>

            <h2>{{ __('Disclaimer') }}</h2>
            <p>
                {{ __('The information provided on ISS-LOOPS is for general informational purposes only. We make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, or availability of the content.') }}
            </p>

            <h2>{{ __('Limitation of Liability') }}</h2>
            <p>
                {{ __('ISS-LOOPS shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use or inability to use the website.') }}
            </p>

            <h2>{{ __('Links to Third-Party Websites') }}</h2>
            <p>
                {{ __('Our website may contain links to third-party websites. We are not responsible for the content or privacy practices of these external sites.') }}
            </p>

            <h2>{{ __('Changes to Terms') }}</h2>
            <p>
                {{ __('We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting on the website.') }}
            </p>

            <h2>{{ __('Contact Information') }}</h2>
            <p>
                {{ __('If you have questions about these Terms and Conditions, please contact us at:') }}
            </p>
            <p>
                <strong>Email:</strong> <a href="mailto:contacto@iss-loops.com">contacto@iss-loops.com</a>
            </p>

            <div class="mt-8 p-4 bg-purple-50 border border-purple-200 rounded-lg">
                <p class="text-sm text-purple-800 mb-0">
                    {{ __('By continuing to use ISS-LOOPS, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions.') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection