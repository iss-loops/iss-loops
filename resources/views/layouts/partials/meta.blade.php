{{-- 
    ISS-LOOPS - SEO Meta Tags
    Incluir en todas las páginas para SEO óptimo
--}}

{{-- Basic Meta Tags --}}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Title --}}
<title>@yield('title', __('ISS-LOOPS - Scientific Communication Magazine'))</title>

{{-- Meta Description --}}
<meta name="description" content="@yield('description', __('Bilingual scientific magazine covering quantum computing, space exploration, biology, and emerging technologies. Making science accessible to everyone.'))">

{{-- Meta Keywords --}}
<meta name="keywords" content="@yield('keywords', 'science, technology, quantum computing, space, biology, physics, scientific communication, bilingual, español, english, divulgación científica')">

{{-- Author --}}
<meta name="author" content="ISS-LOOPS Editorial Team">

{{-- Robots --}}
<meta name="robots" content="@yield('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1')">

{{-- Canonical URL --}}
<link rel="canonical" href="@yield('canonical', url()->current())">

{{-- Hreflang Tags for Multilingual --}}
@php
    $currentPath = request()->path();
    $currentLocale = app()->getLocale();
    
    // Remover el locale actual del path
    if (str_starts_with($currentPath, $currentLocale . '/')) {
        $pathWithoutLocale = substr($currentPath, strlen($currentLocale) + 1);
    } elseif ($currentPath === $currentLocale) {
        $pathWithoutLocale = '';
    } else {
        $pathWithoutLocale = $currentPath;
    }
@endphp

<link rel="alternate" hreflang="es" href="{{ url('es/' . $pathWithoutLocale) }}">
<link rel="alternate" hreflang="en" href="{{ url('en/' . $pathWithoutLocale) }}">
<link rel="alternate" hreflang="x-default" href="{{ url('es/' . $pathWithoutLocale) }}">

{{-- Open Graph Tags --}}
<meta property="og:type" content="@yield('og_type', 'website')">
<meta property="og:site_name" content="ISS-LOOPS">
<meta property="og:title" content="@yield('og_title', __('ISS-LOOPS - Scientific Communication'))">
<meta property="og:description" content="@yield('og_description', __('Bilingual scientific magazine making science accessible to everyone'))">
<meta property="og:url" content="@yield('og_url', url()->current())">
<meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="{{ app()->getLocale() === 'es' ? 'es_MX' : 'en_US' }}">
<meta property="og:locale:alternate" content="{{ app()->getLocale() === 'es' ? 'en_US' : 'es_MX' }}">

{{-- Twitter Card Tags --}}
<meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
<meta name="twitter:site" content="@issloops">
<meta name="twitter:creator" content="@issloops">
<meta name="twitter:title" content="@yield('twitter_title', __('ISS-LOOPS'))">
<meta name="twitter:description" content="@yield('twitter_description', __('Bilingual scientific magazine'))">
<meta name="twitter:image" content="@yield('twitter_image', asset('images/twitter-card.jpg'))">
<meta name="twitter:image:alt" content="@yield('twitter_image_alt', 'ISS-LOOPS Scientific Magazine')">

{{-- Additional Meta Tags --}}
<meta name="theme-color" content="#2563eb">
<meta name="msapplication-TileColor" content="#2563eb">

{{-- Favicon --}}
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

{{-- Preconnect for Performance --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

{{-- DNS Prefetch --}}
<link rel="dns-prefetch" href="https://fonts.googleapis.com">
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">