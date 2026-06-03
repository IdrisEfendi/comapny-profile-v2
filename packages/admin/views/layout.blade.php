<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title.' - ' : '' }}Admin BPR Karawang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <div class="min-h-screen lg:flex">
        <aside class="bg-slate-950 text-white lg:min-h-screen lg:w-72">
            <div class="flex items-center justify-between px-4 py-5 sm:px-6 lg:block lg:px-6">
                <a href="{{ url('admin/dashboard') }}" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-sm font-bold text-blue-800">BPR</span>
                    <span>
                        <span class="block font-bold">Admin Panel</span>
                        <span class="block text-xs text-slate-300">Company Profile</span>
                    </span>
                </a>
                <a href="{{ url('/') }}" class="rounded-full bg-white/10 px-3 py-2 text-xs font-semibold text-slate-200 hover:bg-white/20 lg:mt-6 lg:inline-block">Lihat Website</a>
            </div>

            <nav class="space-y-1 px-4 pb-5 sm:px-6 lg:px-6">
                @php
                    $active = isset($active) ? $active : '';
                    $base = 'block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-white/10 hover:text-white';
                    $on = 'bg-white text-slate-950 hover:bg-white hover:text-slate-950';
                @endphp
                <a href="{{ url('admin/dashboard') }}" class="{{ $base }} {{ $active === 'dashboard' ? $on : '' }}">Dashboard</a>
                <a href="{{ url('admin/settings') }}" class="{{ $base }} {{ $active === 'settings' ? $on : '' }}">Pengaturan</a>
                <a href="{{ url('admin/company-profile') }}" class="{{ $base }} {{ $active === 'company' ? $on : '' }}">Profil Perusahaan</a>
                <a href="{{ url('admin/products') }}" class="{{ $base }} {{ $active === 'products' ? $on : '' }}">Produk</a>
                <a href="{{ url('admin/management') }}" class="{{ $base }} {{ $active === 'management' ? $on : '' }}">Pengurus</a>
                <a href="{{ url('admin/contact-messages') }}" class="{{ $base }} {{ $active === 'messages' ? $on : '' }}">Pesan Kontak</a>
                <a href="{{ url('admin/account') }}" class="{{ $base }} {{ $active === 'account' ? $on : '' }}">Akun Admin</a>
                <a href="{{ url('admin/logout') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-red-200 hover:bg-red-500/20 hover:text-white">Logout</a>
            </nav>
        </aside>

        <main class="flex-1">
            <div class="border-b border-slate-200 bg-white px-4 py-5 sm:px-6 lg:px-8">
                <p class="text-sm text-slate-500">PT BPR Karawang Jabar (Perseroda)</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-950">{{ isset($title) ? $title : 'Admin' }}</h1>
            </div>
            <div class="p-4 sm:p-6 lg:p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
