@php
    $siteSettings = public_settings();
    $siteName = $siteSettings['company_name'];
    $siteTagline = $siteSettings['tagline'];
    $pageTitle = (isset($title) && $title !== '') ? $title.' - '.$siteName : $siteName;
    $pageDescription = (isset($description) && $description !== '') ? $description : $siteName.', '.$siteTagline.'.';
    $pageUrl = \System\URL::current();
    $ogType = isset($og_type) ? $og_type : 'website';
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
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <link rel="icon" type="image/png" href="data:;base64,iVBORw0KGgo=">
    <title>{{ $pageTitle }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('head')
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
