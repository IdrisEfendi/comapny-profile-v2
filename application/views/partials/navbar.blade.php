@php
    $active = isset($active) ? $active : '';
    $settings = isset($siteSettings) ? $siteSettings : public_settings();
    $desktopBase = 'rounded-full px-3 py-2 transition hover:bg-white/10 hover:text-amber-300';
    $desktopActive = 'bg-white text-blue-900 hover:bg-white hover:text-blue-900';
    $mobileBase = 'block rounded-2xl px-4 py-3 text-sm font-semibold text-blue-50 transition hover:bg-white/10 hover:text-amber-300';
    $mobileActive = 'bg-white text-blue-900 hover:bg-white hover:text-blue-900';
@endphp

<header class="sticky top-0 z-50 shadow-lg shadow-slate-900/10">
    <div class="bg-slate-950 text-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-2 text-xs sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p class="text-blue-100">{{ $settings['office_hours'] }}</p>
            <p class="flex flex-wrap gap-x-4 gap-y-1 text-slate-300">
                <span>Telp: {{ $settings['phone'] }}</span>
                <span class="hidden sm:inline">Email: {{ $settings['email'] }}</span>
            </p>
        </div>
    </div>

    <div class="border-b border-blue-800 bg-gradient-to-r from-blue-950 via-blue-900 to-blue-800 text-white">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-3">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white text-sm font-bold text-blue-800 shadow-lg shadow-slate-900/10">BPR</span>
                    <span class="min-w-0">
                        <span class="block truncate text-sm font-bold leading-tight text-white sm:text-base">{{ $settings['company_name'] }}</span>
                        <span class="block text-xs text-blue-100">{{ $settings['tagline'] }}</span>
                    </span>
                </a>

                <div class="hidden items-center gap-2 text-sm font-semibold text-blue-50 lg:flex">
                    <a class="{{ $desktopBase }} {{ $active === 'home' ? $desktopActive : '' }}" href="{{ url('/') }}">Home</a>
                    <a class="{{ $desktopBase }} {{ $active === 'about' ? $desktopActive : '' }}" href="{{ url('tentang-kami') }}">Tentang Kami</a>
                    <a class="{{ $desktopBase }} {{ $active === 'products' ? $desktopActive : '' }}" href="{{ url('produk-layanan') }}">Produk & Layanan</a>
                    <a class="{{ $desktopBase }} {{ $active === 'management' ? $desktopActive : '' }}" href="{{ url('pengurus') }}">Pengurus</a>
                    <a class="{{ $desktopBase }} {{ $active === 'contact' ? $desktopActive : '' }}" href="{{ url('kontak') }}">Kontak</a>
                </div>

                <div class="hidden items-center gap-3 lg:flex">
                    <a href="{{ url('kontak') }}" class="rounded-full bg-amber-400 px-6 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-slate-900/10 hover:bg-amber-300">Hubungi Kami</a>
                </div>

                <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/20 text-white transition hover:bg-white/10 lg:hidden" aria-controls="mobile-menu" aria-expanded="false" data-mobile-menu-button>
                    <span class="sr-only">Buka menu navigasi</span>
                    <svg class="h-6 w-6" data-menu-icon-open fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="hidden h-6 w-6" data-menu-icon-close fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden pb-4 lg:hidden" data-mobile-menu>
                <div class="space-y-2 rounded-3xl border border-white/10 bg-blue-950 p-3 shadow-lg shadow-slate-950/20">
                    <a class="{{ $mobileBase }} {{ $active === 'home' ? $mobileActive : '' }}" href="{{ url('/') }}">Home</a>
                    <a class="{{ $mobileBase }} {{ $active === 'about' ? $mobileActive : '' }}" href="{{ url('tentang-kami') }}">Tentang Kami</a>
                    <a class="{{ $mobileBase }} {{ $active === 'products' ? $mobileActive : '' }}" href="{{ url('produk-layanan') }}">Produk & Layanan</a>
                    <a class="{{ $mobileBase }} {{ $active === 'management' ? $mobileActive : '' }}" href="{{ url('pengurus') }}">Pengurus</a>
                    <a class="{{ $mobileBase }} {{ $active === 'contact' ? $mobileActive : '' }}" href="{{ url('kontak') }}">Kontak</a>
                    <a href="{{ url('kontak') }}" class="mt-3 flex items-center justify-center rounded-2xl bg-amber-400 px-4 py-3 text-sm font-bold text-slate-950 hover:bg-amber-300">Hubungi Kami</a>
                </div>
            </div>
        </nav>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var button = document.querySelector('[data-mobile-menu-button]');
        var menu = document.querySelector('[data-mobile-menu]');
        var openIcon = document.querySelector('[data-menu-icon-open]');
        var closeIcon = document.querySelector('[data-menu-icon-close]');

        if (!button || !menu) {
            return;
        }

        button.addEventListener('click', function () {
            var isOpen = !menu.classList.contains('hidden');

            menu.classList.toggle('hidden', isOpen);
            button.setAttribute('aria-expanded', isOpen ? 'false' : 'true');

            if (openIcon && closeIcon) {
                openIcon.classList.toggle('hidden', !isOpen);
                closeIcon.classList.toggle('hidden', isOpen);
            }
        });
    });
</script>
