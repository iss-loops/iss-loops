<head>
    {{-- SEO Meta Tags --}}
    @include('layouts.partials.meta')
    
    {{-- ✅ FAVICONS COMPLETOS --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#2563eb">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#2563eb">
    
    {{-- Structured Data --}}
    {{-- @include('layouts.partials.structured-data') --}}
    
    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Livewire Styles --}}
    @livewireStyles
    
    {{-- Additional Styles --}}
    @stack('styles')
</head>
<body class="bg-gray-50 antialiased">
    @include('layouts.partials.nav')
    
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    @include('layouts.partials.footer')
    
    @livewireScripts
    
    @stack('scripts')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Livewire status:', typeof Livewire !== 'undefined' ? 'Loaded ✓' : 'Not loaded ✗');
        });
    </script>
</body>
</html>