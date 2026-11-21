<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title.' - ' : '' }}Admin BPR Karawang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('head')
</head>
<body class="min-h-screen bg-[#f4f5f1] text-slate-800 antialiased">
    <div class="min-h-screen lg:flex">
        <aside class="bg-[#102b35] text-white lg:min-h-screen lg:w-72 lg:shrink-0">
            <div class="flex items-center justify-between px-4 py-5 sm:px-6 lg:block lg:px-6">
                <a href="{{ url('admin/dashboard') }}" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl border border-white/15 bg-white/10 text-sm font-black tracking-wide text-[#f0c66f]">BPR</span>
                    <span>
                        <span class="block font-bold">Admin Panel</span>
                        <span class="block text-xs text-white/55">Company Profile</span>
                    </span>
                </a>
                <a href="{{ url('/') }}" class="rounded-full border border-white/15 px-3 py-2 text-xs font-semibold text-white/75 transition hover:bg-white/10 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-[#f0c66f] lg:mt-6 lg:inline-block">Lihat Website</a>
            </div>

            @php
                $active = isset($active) ? $active : '';
                $base = 'block rounded-xl px-4 py-3 text-sm font-medium text-white/65 transition hover:bg-white/10 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-[#f0c66f]';
                $on = 'bg-white/10 font-semibold text-white ring-1 ring-white/10 hover:bg-white/10';
                $navUnreadCount = admin_is_logged_in() ? admin_count_unread_contact_messages() : 0;
            @endphp
            <details class="group border-t border-white/10 lg:border-0" open>
                <summary class="flex cursor-pointer list-none items-center justify-between px-4 py-4 text-sm font-semibold text-white/80 focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-[#f0c66f] sm:px-6 lg:hidden">
                    <span>Menu navigasi</span>
                    <svg class="h-4 w-4 transition-transform group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.22 7.22a.75.75 0 0 1 1.06 0L10 10.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 8.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/></svg>
                </summary>
                <nav aria-label="Navigasi admin" class="space-y-1 px-4 pb-5 sm:px-6 lg:px-6">
                    <a href="{{ url('admin/dashboard') }}" class="{{ $base }} {{ $active === 'dashboard' ? $on : '' }}" {{ $active === 'dashboard' ? 'aria-current=page' : '' }}>Dashboard</a>
                    <a href="{{ url('admin/settings') }}" class="{{ $base }} {{ $active === 'settings' ? $on : '' }}" {{ $active === 'settings' ? 'aria-current=page' : '' }}>Pengaturan</a>
                    <a href="{{ url('admin/company-profile') }}" class="{{ $base }} {{ $active === 'company' ? $on : '' }}" {{ $active === 'company' ? 'aria-current=page' : '' }}>Profil Perusahaan</a>
                    <a href="{{ url('admin/products') }}" class="{{ $base }} {{ $active === 'products' ? $on : '' }}" {{ $active === 'products' ? 'aria-current=page' : '' }}>Produk</a>
                    <a href="{{ url('admin/management') }}" class="{{ $base }} {{ $active === 'management' ? $on : '' }}" {{ $active === 'management' ? 'aria-current=page' : '' }}>Pengurus</a>
                    <a href="{{ url('admin/news') }}" class="{{ $base }} {{ $active === 'news' ? $on : '' }}" {{ $active === 'news' ? 'aria-current=page' : '' }}>Berita & Pengumuman</a>
                    <a href="{{ url('admin/contact-messages') }}" class="{{ $base }} {{ $active === 'messages' ? $on : '' }}" {{ $active === 'messages' ? 'aria-current=page' : '' }}>
                        <span class="flex items-center justify-between gap-3">
                            <span>Pesan Kontak</span>
                            @if ($navUnreadCount > 0)
                                <span class="rounded-full bg-[#f0c66f] px-2 py-0.5 text-xs font-bold text-[#102b35]">{{ $navUnreadCount }}</span>
                            @endif
                        </span>
                    </a>
                    <a href="{{ url('admin/account') }}" class="{{ $base }} {{ $active === 'account' ? $on : '' }}" {{ $active === 'account' ? 'aria-current=page' : '' }}>Akun Admin</a>
                    <form action="{{ url('admin/logout') }}" method="post">
                        @php echo csrf_field(); @endphp
                        <button type="submit" class="block w-full rounded-xl px-4 py-3 text-left text-sm font-medium text-red-200 transition hover:bg-red-500/15 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-red-300">Logout</button>
                    </form>
                </nav>
            </details>
        </aside>

        <main class="flex-1">
            <div class="border-b border-slate-200/80 bg-white px-4 py-5 sm:px-6 lg:px-10">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">PT BPR Karawang Jabar (Perseroda)</p>
                <h1 class="mt-2 text-2xl font-semibold tracking-tight text-[#172b31]">{{ isset($title) ? $title : 'Admin' }}</h1>
            </div>
            <div class="p-4 sm:p-6 lg:p-10">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
