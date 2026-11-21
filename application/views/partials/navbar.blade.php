@php
    $active = isset($active) ? $active : '';
    $settings = isset($siteSettings) ? $siteSettings : public_settings();
    $desktopBase = 'rounded-full px-3 py-2 transition hover:bg-white/10 hover:text-[#f0c66f] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#f0c66f]';
    $desktopActive = 'bg-white/10 text-white hover:bg-white/10 hover:text-white';
    $mobileBase = 'block rounded-2xl px-4 py-3 text-sm font-semibold text-white/80 transition hover:bg-white/10 hover:text-[#f0c66f] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#f0c66f]';
    $mobileActive = 'bg-white/10 text-white hover:bg-white/10 hover:text-white';
@endphp

<header class="sticky top-0 z-50 shadow-lg shadow-slate-900/10" data-site-header>
    <div class="bg-[#0a2027] text-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-2 text-xs sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p class="text-white/75">{{ $settings['office_hours'] }}</p>
            <p class="flex flex-wrap gap-x-4 gap-y-1 text-slate-300">
                <span>Telp: {{ $settings['phone'] }}</span>
                <span class="hidden sm:inline">Email: {{ $settings['email'] }}</span>
            </p>
        </div>
    </div>

    <div class="border-b border-white/10 bg-gradient-to-r from-[#102b35] via-[#173f46] to-[#28544c] text-white">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-3">
                    @if (! empty($settings['logo_path']))
                        <img src="{{ asset($settings['logo_path']) }}" alt="Logo {{ $settings['company_name'] }}" class="h-11 w-11 shrink-0 rounded-2xl bg-white object-contain p-1 shadow-lg shadow-slate-900/10">
                    @else
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-white/15 bg-white/10 text-sm font-black tracking-wide text-[#f0c66f] shadow-lg shadow-slate-900/10">BPR</span>
                    @endif
                    <span class="min-w-0">
                        <span class="block truncate text-sm font-bold leading-tight text-white sm:text-base">{{ $settings['company_name'] }}</span>
                        <span class="block text-xs text-white/65">{{ $settings['tagline'] }}</span>
                    </span>
                </a>

                <div class="hidden items-center gap-2 text-sm font-semibold text-white/80 lg:flex">
                    <a class="{{ $desktopBase }} {{ $active === 'home' ? $desktopActive : '' }}" href="{{ url('/') }}" @if ($active === 'home') aria-current="page" @endif>Home</a>
                    <a class="{{ $desktopBase }} {{ $active === 'about' ? $desktopActive : '' }}" href="{{ url('tentang-kami') }}" @if ($active === 'about') aria-current="page" @endif>Tentang Kami</a>
                    <a class="{{ $desktopBase }} {{ $active === 'products' ? $desktopActive : '' }}" href="{{ url('produk-layanan') }}" @if ($active === 'products') aria-current="page" @endif>Produk & Layanan</a>
                    <a class="{{ $desktopBase }} {{ $active === 'management' ? $desktopActive : '' }}" href="{{ url('pengurus') }}" @if ($active === 'management') aria-current="page" @endif>Pengurus</a>
                    <a class="{{ $desktopBase }} {{ $active === 'news' ? $desktopActive : '' }}" href="{{ url('berita') }}" @if ($active === 'news') aria-current="page" @endif>Berita</a>
                    <a class="{{ $desktopBase }} {{ $active === 'contact' ? $desktopActive : '' }}" href="{{ url('kontak') }}" @if ($active === 'contact') aria-current="page" @endif>Kontak</a>
                </div>

                <div class="hidden items-center gap-3 lg:flex">
                    <a href="{{ url('kontak') }}" class="rounded-full bg-[#f0c66f] px-6 py-3 text-sm font-bold text-[#102b35] shadow-lg shadow-slate-900/10 transition hover:bg-amber-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white">Hubungi Kami</a>
                </div>

                <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/20 text-white transition hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 lg:hidden" aria-controls="mobile-menu" aria-expanded="false" data-mobile-menu-button>
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
                    <div class="space-y-2 rounded-3xl border border-white/10 bg-[#102b35] p-3 shadow-lg shadow-slate-950/20">
                    <a class="{{ $mobileBase }} {{ $active === 'home' ? $mobileActive : '' }}" href="{{ url('/') }}" @if ($active === 'home') aria-current="page" @endif>Home</a>
                    <a class="{{ $mobileBase }} {{ $active === 'about' ? $mobileActive : '' }}" href="{{ url('tentang-kami') }}" @if ($active === 'about') aria-current="page" @endif>Tentang Kami</a>
                    <a class="{{ $mobileBase }} {{ $active === 'products' ? $mobileActive : '' }}" href="{{ url('produk-layanan') }}" @if ($active === 'products') aria-current="page" @endif>Produk & Layanan</a>
                    <a class="{{ $mobileBase }} {{ $active === 'management' ? $mobileActive : '' }}" href="{{ url('pengurus') }}" @if ($active === 'management') aria-current="page" @endif>Pengurus</a>
                    <a class="{{ $mobileBase }} {{ $active === 'news' ? $mobileActive : '' }}" href="{{ url('berita') }}" @if ($active === 'news') aria-current="page" @endif>Berita</a>
                    <a class="{{ $mobileBase }} {{ $active === 'contact' ? $mobileActive : '' }}" href="{{ url('kontak') }}" @if ($active === 'contact') aria-current="page" @endif>Kontak</a>
                    <a href="{{ url('kontak') }}" class="mt-3 flex items-center justify-center rounded-2xl bg-amber-400 px-4 py-3 text-sm font-bold text-slate-950 hover:bg-amber-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white">Hubungi Kami</a>
                </div>
            </div>
        </nav>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var header = document.querySelector('[data-site-header]');
        var button = document.querySelector('[data-mobile-menu-button]');
        var menu = document.querySelector('[data-mobile-menu]');
        var openIcon = document.querySelector('[data-menu-icon-open]');
        var closeIcon = document.querySelector('[data-menu-icon-close]');

        if (!button || !menu) {
            return;
        }

        if (header) {
            var updateHeaderHeight = function () {
                document.documentElement.style.setProperty('--site-header-height', header.offsetHeight + 'px');
            };

            updateHeaderHeight();

            if (typeof ResizeObserver !== 'undefined') {
                new ResizeObserver(updateHeaderHeight).observe(header);
            } else {
                window.addEventListener('resize', updateHeaderHeight);
            }
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

        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.add('hidden');
                button.setAttribute('aria-expanded', 'false');

                if (openIcon && closeIcon) {
                    openIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });
        });
    });
</script>
