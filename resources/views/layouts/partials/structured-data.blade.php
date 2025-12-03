{{-- Organization Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "ISS-LOOPS",
    "description": "{{ __('Bilingual scientific communication magazine') }}",
    "url": "{{ url('/') }}",
    "logo": {
        "@type": "ImageObject",
        "url": "{{ asset('images/logo.png') }}",
        "width": "400",
        "height": "400"
    },
    "sameAs": [
        "https://twitter.com/issloops",
        "https://facebook.com/issloops",
        "https://instagram.com/issloops"
    ],
    "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "Editorial",
        "email": "contacto@iss-loops.com",
        "availableLanguage": ["Spanish", "English"]
    }
}
</script>

{{-- WebSite Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "ISS-LOOPS",
    "url": "{{ url('/') }}",
    "description": "{{ __('Bilingual scientific communication magazine') }}",
    "inLanguage": ["es", "en"],
    "potentialAction": {
        "@type": "SearchAction",
        "target": {
            "@type": "EntryPoint",
            "urlTemplate": "{{ route('articles.index', ['locale' => app()->getLocale()]) }}?search={search_term_string}"
        },
        "query-input": "required name=search_term_string"
    }
}
</script>

@yield('breadcrumb_schema')

@yield('structured_data')