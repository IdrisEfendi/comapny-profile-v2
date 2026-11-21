@php
    $siteSettings = public_settings();
    $siteName = $siteSettings['company_name'];
    $siteTagline = $siteSettings['tagline'];
    $pageTitle = (isset($title) && $title !== '') ? $title.' - '.$siteName : $siteName;
    $pageDescription = (isset($description) && $description !== '') ? $description : $siteName.', '.$siteTagline.'.';
    $configuredUrl = rtrim((string) env('APP_URL', ''), '/');
    $pageUrl = $configuredUrl !== '' ? $configuredUrl.parse_url(\System\URL::current(), PHP_URL_PATH) : \System\URL::current();
    $ogType = isset($og_type) ? $og_type : 'website';
    $ogImage = isset($og_image) && $og_image !== '' ? $og_image : asset('og-company-profile.svg');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ $pageUrl }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $pageUrl }}">
    <meta property="og:locale" content="id_ID">
    @if ($ogImage !== '')
        <meta property="og:image" content="{{ $ogImage }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    @if ($ogImage !== '')
        <meta name="twitter:image" content="{{ $ogImage }}">
    @endif
    <link rel="icon" type="image/png" href="{{ $ogImage !== '' ? $ogImage : 'data:;base64,iVBORw0KGgo=' }}">
    <title>{{ $pageTitle }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#edf3ef',
                            100: '#d9e6df',
                            500: '#47776b',
                            600: '#34665d',
                            700: '#28544c',
                            800: '#173f46',
                            900: '#102b35'
                        },
                        accent: { 500: '#d6a64b', 600: '#9a742b' }
                    },
                    boxShadow: { soft: '0 18px 45px rgba(15, 23, 42, 0.08)' }
                }
            }
        };
    </script>
    <style>
        html:not(.js) [data-mobile-menu] { display: block; }
        html:not(.js) [data-mobile-menu-button] { display: none; }
    </style>
    <script>document.documentElement.classList.add('js');</script>
    @yield('head')
</head>
<body class="min-h-screen bg-[#f5f4ef] text-slate-800 antialiased">
    @include('partials.navbar')

    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-4 focus:py-3 focus:text-sm focus:font-bold focus:text-slate-950 focus:shadow-lg">
        Lewati ke konten utama
    </a>

    <main id="main-content">
        @yield('content')
    </main>

    @include('partials.footer')
    <script src="{{ asset('js/scroll-reveal.js') }}" defer></script>
</body>
</html>
