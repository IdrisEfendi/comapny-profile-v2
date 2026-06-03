<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PT BPR Karawang Jabar (Perseroda), mitra keuangan masyarakat Karawang.">
    <link rel="icon" type="image/png" href="data:;base64,iVBORw0KGgo=">
    <title>{{ isset($title) ? $title.' - ' : '' }}PT BPR Karawang Jabar (Perseroda)</title>
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
