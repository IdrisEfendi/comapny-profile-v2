@php
    $siteSettings = public_settings();
    $siteName = $siteSettings['company_name'];
    $siteTagline = $siteSettings['tagline'];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $siteName }}, {{ $siteTagline }}.">
    <link rel="icon" type="image/png" href="data:;base64,iVBORw0KGgo=">
    <title>{{ isset($title) ? $title.' - ' : '' }}{{ $siteName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
