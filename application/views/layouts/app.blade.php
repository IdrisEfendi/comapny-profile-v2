@php
    $siteSettings = public_settings();
    $siteName = $siteSettings['company_name'];
    $siteTagline = $siteSettings['tagline'];
    $pageTitle = (isset($title) && $title !== '') ? $title.' - '.$siteName : $siteName;
    $pageDescription = (isset($description) && $description !== '') ? $description : $siteName.', '.$siteTagline.'.';
    $configuredUrl = rtrim((string) env('APP_URL', ''), '/');
    $pageUrl = $configuredUrl !== '' ? $configuredUrl.parse_url(\System\URL::current(), PHP_URL_PATH) : \System\URL::current();
    $ogType = isset($og_type) ? $og_type : 'website';
    $ogImage = isset($og_image) && $og_image !== '' ? $og_image : (! empty($siteSettings['logo_path']) ? asset($siteSettings['logo_path']) : '');
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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        html:not(.js) [data-mobile-menu] { display: block; }
        html:not(.js) [data-mobile-menu-button] { display: none; }
    </style>
    <script>document.documentElement.classList.add('js');</script>
    @yield('head')
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
    @include('partials.navbar')

    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-4 focus:py-3 focus:text-sm focus:font-bold focus:text-slate-950 focus:shadow-lg">
        Lewati ke konten utama
    </a>

    <main id="main-content">
        @yield('content')
    </main>

    @include('partials.footer')
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof AOS === 'undefined') {
                return;
            }

            AOS.init({
                duration: 700,
                easing: 'ease-out-cubic',
                once: true,
                offset: 80,
                disable: window.matchMedia('(prefers-reduced-motion: reduce)').matches
            });
        });
    </script>
</body>
</html>
