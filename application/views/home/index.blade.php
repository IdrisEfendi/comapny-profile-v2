@layout('layouts.app')

@php
    $jsonLdSettings = public_settings();
    $homeProduct = public_featured_product();
    $homeManagement = public_management();
    $homeProfile = public_company_profile();
    $homeNews = array_slice(public_news(), 0, 3);
    $jsonLdRequest = \System\Request::foundation();
    $jsonLdBase = $jsonLdRequest->getScheme().'://'.$jsonLdRequest->getHttpHost();
    $jsonLdSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FinancialService',
        'name' => $jsonLdSettings['company_name'],
        'description' => $jsonLdSettings['tagline'],
        'url' => $jsonLdBase.'/',
        'telephone' => $jsonLdSettings['phone'],
        'email' => $jsonLdSettings['email'],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $jsonLdSettings['address'],
            'addressCountry' => 'ID',
        ],
        'openingHours' => 'Mo-Fr 08:00-14:00',
        'priceRange' => '$$',
    ];
@endphp

@section('head')
<script type="application/ld+json">
{!! json_encode($jsonLdSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
<style>
    @keyframes hero-fade-up {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes hero-orb-drift {
        0%, 100% { transform: translate3d(0, 0, 0); }
        50% { transform: translate3d(18px, 10px, 0); }
    }

    .hero-fade-up {
        opacity: 0;
        animation: hero-fade-up 700ms cubic-bezier(.22, 1, .36, 1) forwards;
    }

    .hero-delay-1 { animation-delay: 100ms; }
    .hero-delay-2 { animation-delay: 220ms; }
    .hero-delay-3 { animation-delay: 340ms; }
    .hero-delay-4 { animation-delay: 460ms; }
    .hero-orb { animation: hero-orb-drift 9s ease-in-out infinite; }

    .home-hero {
        min-height: min(760px, calc(100svh - var(--site-header-height, 7rem)));
        background: #eee5d1;
    }

    .home-hero-grid {
        background-image: linear-gradient(rgba(16, 43, 53, .035) 1px, transparent 1px), linear-gradient(90deg, rgba(16, 43, 53, .035) 1px, transparent 1px);
        background-size: 40px 40px;
        mask-image: linear-gradient(to right, transparent, black 35%, black);
    }

    .hero-visual-card {
        box-shadow: 0 32px 80px rgba(16, 43, 53, .18);
    }

    .home-section-title { text-wrap: balance; }

    .home-page {
        --home-sage: #d8e4d8;
        --home-ivory: #eee5d1;
        --home-card: #e5ecdf;
        background: var(--home-sage);
    }

    .home-page > .home-section-sage { background-color: var(--home-sage) !important; }
    .home-page > .home-section-ivory { background-color: var(--home-ivory) !important; }
    .home-page .home-surface { background-color: var(--home-card) !important; }

    .home-card {
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
    }

    .home-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 22px 48px rgba(16, 43, 53, .12);
    }

    .home-page a:focus-visible {
        outline: 3px solid #b88a3b;
        outline-offset: 4px;
    }

    @media (max-width: 640px) {
        .home-hero { min-height: auto; }
        .home-hero-grid { mask-image: linear-gradient(to bottom, transparent, black 20%, black); }
    }

    @media (prefers-reduced-motion: reduce) {
        .hero-fade-up {
            opacity: 1;
            animation: none;
        }

        .hero-orb { animation: none; }
        .home-card { transition: none; }
        .home-card:hover { transform: none; }
    }
</style>
@endsection

@section('content')
<div class="home-page">
<section class="home-hero relative isolate overflow-hidden">
    <div class="home-hero-grid absolute inset-0 opacity-70"></div>
    <div class="hero-orb absolute -right-40 -top-48 h-[32rem] w-[32rem] rounded-full bg-amber-200/45 blur-3xl"></div>
    <div class="hero-orb absolute -bottom-56 left-1/3 h-[28rem] w-[28rem] rounded-full bg-brand-500/10 blur-3xl" style="animation-delay: -4s;"></div>
    <div class="relative mx-auto grid min-h-[inherit] max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 sm:py-20 lg:grid-cols-[1.05fr_.95fr] lg:px-8 lg:py-24">
        <div class="relative z-10">
            <div class="hero-fade-up hero-delay-1 inline-flex items-center gap-3 rounded-full border border-brand-800/10 bg-[#d8e4d8] px-4 py-2 text-[11px] font-bold uppercase tracking-[0.2em] text-brand-800 shadow-sm backdrop-blur">
                <span class="h-2 w-2 rounded-full bg-[#b88a3b]"></span>
                <span>Profil Perusahaan</span>
            </div>
            <p class="hero-fade-up hero-delay-2 mt-7 text-sm font-bold tracking-wide text-[#526a61]">{{ $jsonLdSettings['company_name'] }}</p>
            <h1 class="hero-fade-up hero-delay-2 home-section-title mt-4 max-w-3xl text-[2.65rem] font-black leading-[1.02] tracking-[-0.045em] text-[#14353a] sm:text-6xl lg:text-[4.5rem]">{{ $jsonLdSettings['tagline'] }}</h1>
            <p class="hero-fade-up hero-delay-3 mt-6 max-w-xl text-base leading-7 text-[#59635f] sm:text-lg sm:leading-8">{{ $homeProfile['hero_intro'] }}</p>
            <div class="hero-fade-up hero-delay-4 mt-8 flex flex-col gap-3 sm:mt-10 sm:flex-row">
                <a href="{{ url('kontak') }}" class="inline-flex items-center justify-center gap-3 rounded-full bg-[#173f46] px-7 py-4 text-sm font-bold text-white shadow-xl shadow-brand-900/15 transition hover:bg-[#102f35] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#b88a3b] focus-visible:ring-offset-2">Hubungi Kami <span aria-hidden="true">→</span></a>
                <a href="{{ url('produk-layanan') }}" class="inline-flex items-center justify-center rounded-full border border-[#173f46]/20 bg-[#e9eee8] px-7 py-4 text-sm font-bold text-[#173f46] transition hover:border-[#173f46]/50 hover:bg-[#dce6dc] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#b88a3b] focus-visible:ring-offset-2">Jelajahi Produk</a>
            </div>
            <div class="hero-fade-up hero-delay-4 mt-9 flex items-center gap-3 text-xs font-semibold text-[#526a61] sm:mt-12">
                <span class="h-px w-8 bg-[#b88a3b]" aria-hidden="true"></span>
                <span>Berakar di Karawang, hadir untuk masyarakat.</span>
            </div>
        </div>

        <div class="relative mx-auto w-full max-w-lg py-4 lg:py-12">
            <div class="absolute -right-3 top-0 h-32 w-32 rounded-full border border-brand-800/10 sm:-right-8 sm:h-48 sm:w-48"></div>
            <div class="absolute -bottom-2 left-0 h-28 w-28 rounded-full border border-amber-500/30 sm:-left-7 sm:h-40 sm:w-40"></div>
            <div class="hero-fade-up hero-delay-3 hero-visual-card relative overflow-hidden rounded-[2rem] border border-white/70 bg-gradient-to-br from-brand-900 via-brand-800 to-brand-700 p-6 text-white sm:rounded-[2.5rem] sm:p-9">
                <div class="absolute -right-16 -top-20 h-64 w-64 rounded-full border border-white/10"></div>
                <div class="absolute -right-5 -top-9 h-44 w-44 rounded-full border border-white/10"></div>
                <div class="relative flex items-center justify-between gap-4">
                    <div><p class="text-xs font-semibold uppercase tracking-[0.18em] text-brand-100">Berdiri untuk tumbuh</p><p class="mt-2 text-sm font-bold">Bersama masyarakat</p></div>
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-amber-300" aria-hidden="true"><svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 20h18M5 20V8l7-4 7 4v12M9 20v-6h6v6M8 9h.01M12 9h.01M16 9h.01"/></svg></span>
                </div>
                <div class="relative mt-12 rounded-3xl border border-white/10 bg-white/[0.08] p-5 backdrop-blur sm:mt-16 sm:p-7">
                    <div class="flex items-end justify-between gap-3"><div><p class="text-xs font-semibold uppercase tracking-widest text-brand-100">Komitmen kami</p><p class="mt-2 text-2xl font-black tracking-tight sm:text-3xl">Tumbuh bersama</p><p class="mt-1 text-sm text-white/70">Karawang, Jawa Barat</p></div><span class="mb-1 flex h-11 w-11 items-center justify-center rounded-full bg-amber-300 text-brand-950" aria-hidden="true"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17 17 7M7 7h10v10"/></svg></span></div>
                    <div class="mt-8 grid gap-3 border-t border-white/15 pt-6 text-sm sm:grid-cols-2">
                        <div><span class="block text-xs uppercase tracking-widest text-brand-100">Wilayah layanan</span><span class="mt-2 block font-semibold text-white">{{ $homeProfile['area_service'] }}</span></div>
                        <div><span class="block text-xs uppercase tracking-widest text-brand-100">Informasi resmi</span><span class="mt-2 block font-semibold text-white">Produk, berita, dan kontak kantor</span></div>
                    </div>
                    <div class="mt-6 border-t border-white/15 pt-4 text-xs font-medium text-white/80">Kepercayaan · Transparansi · Layanan</div>
                </div>
            </div>
            <div class="hero-fade-up hero-delay-4 absolute -bottom-4 right-1 rounded-2xl border border-brand-800/10 bg-[#f7f5ef] px-4 py-3 shadow-xl shadow-brand-900/10 sm:-right-5 sm:bottom-0 sm:px-5 sm:py-4"><p class="text-[10px] font-bold uppercase tracking-widest text-[#526a61]">Mitra lokal Anda</p><p class="mt-1 text-sm font-extrabold text-[#173f46]">Dekat dengan Karawang</p></div>
        </div>
    </div>
</section>

<section class="home-section-sage py-16 sm:py-20" data-aos="fade-up">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-[2rem] bg-brand-900 p-6 text-white shadow-2xl shadow-brand-900/20 sm:rounded-[2.5rem] sm:p-10 lg:p-12">
            <div class="grid gap-10 lg:grid-cols-[1fr_1.4fr] lg:items-end">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-brand-100">Informasi Kantor</p>
                    <h2 class="mt-4 text-3xl font-black tracking-tight sm:text-4xl">Hubungi {{ $jsonLdSettings['company_name'] }}</h2>
                    <p class="mt-4 max-w-xl leading-7 text-brand-100">Gunakan kanal resmi berikut untuk mendapatkan informasi layanan dan menghubungi kantor pada jam operasional.</p>
                    <a href="{{ url('kontak') }}" class="mt-7 inline-flex rounded-2xl bg-amber-300 px-6 py-3.5 text-sm font-bold text-slate-950 hover:bg-amber-200">Lihat Kontak Lengkap</a>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <a href="{{ public_phone_href($jsonLdSettings['phone']) }}" class="rounded-2xl border border-white/10 bg-white/[0.08] p-5 transition hover:bg-white/15">
                        <span class="text-xs font-bold uppercase tracking-widest text-brand-100">Telepon</span>
                        <span class="mt-2 block font-bold text-white">{{ $jsonLdSettings['phone'] }}</span>
                    </a>
                    <a href="mailto:{{ $jsonLdSettings['email'] }}" class="rounded-2xl border border-white/10 bg-white/[0.08] p-5 transition hover:bg-white/15">
                        <span class="text-xs font-bold uppercase tracking-widest text-brand-100">Email</span>
                        <span class="mt-2 block break-all font-bold text-white">{{ $jsonLdSettings['email'] }}</span>
                    </a>
                    <div class="rounded-2xl border border-white/10 bg-white/[0.08] p-5 sm:col-span-2">
                        <span class="text-xs font-bold uppercase tracking-widest text-brand-100">Alamat dan Jam Layanan</span>
                        <span class="mt-2 block font-bold text-white">{{ $jsonLdSettings['address'] }}</span>
                        <span class="mt-1 block text-sm text-brand-100">{{ $jsonLdSettings['office_hours'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-section-ivory py-20 sm:py-24" data-aos="fade-up">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Berita Terbaru</p>
                <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Informasi terbaru dari BPR</h2>
                <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Ikuti informasi dan pengumuman terbaru yang dipublikasikan melalui kanal resmi {{ $jsonLdSettings['company_name'] }}.</p>
            </div>
            <a href="{{ url('berita') }}" class="inline-flex items-center justify-center rounded-full border border-brand-800/15 bg-[#f7f5ef] px-6 py-3 text-sm font-bold text-brand-900 hover:border-brand-700 hover:bg-white">Lihat Semua Berita</a>
        </div>

        @if (count($homeNews) === 0)
            <div class="mt-10 rounded-3xl border border-dashed border-brand-800/20 bg-[#f7f5ef] p-10 text-center">
                <h3 class="text-xl font-bold text-slate-950">Belum ada berita terbaru</h3>
                <p class="mt-3 leading-7 text-slate-600">Informasi dan pengumuman akan ditampilkan setelah tersedia di database.</p>
            </div>
        @else
            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ($homeNews as $item)
                    <article class="home-card home-surface flex flex-col overflow-hidden rounded-3xl border border-brand-800/10 shadow-lg shadow-slate-900/10" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @if (! empty($item['image_path']))
                            <img src="{{ asset($item['image_path']) }}" alt="{{ $item['title'] }}" class="h-48 w-full object-cover">
                        @else
                            <div class="flex h-48 items-center justify-center bg-gradient-to-br from-brand-900 to-brand-700 text-4xl font-black text-white">{{ strtoupper(substr($item['title'], 0, 1)) }}</div>
                        @endif
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex flex-wrap items-center gap-3 text-xs font-semibold text-brand-700">
                                @if ($item['category'] !== '')
                                    <span>{{ $item['category'] }}</span>
                                @endif
                                @if (public_format_date($item['published_at']) !== '')
                                    <span class="text-slate-500">{{ public_format_date($item['published_at']) }}</span>
                                @endif
                            </div>
                            <h3 class="mt-4 text-xl font-bold leading-tight text-slate-950">{{ $item['title'] }}</h3>
                            <p class="mt-3 line-clamp-3 flex-1 leading-7 text-slate-600">{{ $item['summary'] }}</p>
                            <a href="{{ url('berita/'.$item['slug']) }}" class="mt-6 inline-flex self-start rounded-full bg-brand-800 px-5 py-2.5 text-sm font-bold text-white hover:bg-brand-900">Baca Berita</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="home-section-sage py-20 sm:py-24" data-aos="fade-up">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-12 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Tentang Kami</p>
             <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">{{ $homeProfile['profile_heading'] }}</h2>
             <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">{{ $homeProfile['profile_summary'] }}</p>
            <a href="{{ url('tentang-kami') }}" class="inline-flex items-center justify-center rounded-full bg-brand-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-brand-900 mt-8">Pelajari Profil</a>
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
            <div class="home-card home-surface rounded-3xl border border-brand-800/10 p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-100 text-brand-700">01</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Lokal & Dekat</h3>
                 <p class="mt-3 text-sm leading-6 text-slate-600">{{ $homeProfile['area_service'] }}</p>
            </div>
            <div class="home-card home-surface rounded-3xl border border-brand-800/10 p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">02</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Informasi Terbuka</h3>
                 <p class="mt-3 text-sm leading-6 text-slate-600">{{ $homeProfile['information_focus'] }}</p>
            </div>
            <div class="home-card home-surface rounded-3xl border border-brand-800/10 p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">03</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Mudah Dihubungi</h3>
                 <p class="mt-3 text-sm leading-6 text-slate-600">{{ $homeProduct['detail_label'] ?? 'Hubungi kantor untuk informasi lebih lanjut.' }}</p>
            </div>
            <div class="home-card home-surface rounded-3xl border border-brand-800/10 p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">04</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Kanal Resmi</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Temukan informasi produk, berita, dan kontak kantor dalam satu tempat.</p>
            </div>
        </div>
    </div>
</section>

<section class="home-section-ivory py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Produk Unggulan</p>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Produk & Layanan</h2>
                 <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">{{ $homeProduct ? $homeProduct['summary'] : 'Informasi produk akan tersedia melalui database.' }}</p>
            </div>
            <a href="{{ url('produk-layanan') }}" class="inline-flex items-center justify-center rounded-full border border-brand-800/15 bg-[#f7f5ef] px-6 py-3 text-sm font-bold text-brand-900 hover:border-brand-700 hover:bg-white">Lihat Semua Produk</a>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            <article class="rounded-3xl border border-slate-200 bg-gradient-to-br from-brand-900 to-brand-700 p-8 text-white shadow-lg shadow-slate-900/10">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#f1eee4] text-xl font-bold text-brand-800">T</div>
                 <p class="mt-8 text-sm font-semibold text-brand-100">{{ $homeProduct['subtitle'] ?? 'Produk dan layanan' }}</p>
                 <h3 class="mt-2 text-3xl font-bold">{{ $homeProduct['name'] ?? 'Produk' }}</h3>
                 <p class="mt-4 max-w-2xl leading-7 text-brand-50">{{ $homeProduct['summary'] ?? 'Belum ada produk unggulan.' }}</p>
                 @if ($homeProduct)
                      <a href="{{ url('produk/'.$homeProduct['slug']) }}" class="mt-8 inline-flex rounded-full bg-[#f1eee4] px-6 py-3 text-sm font-semibold text-brand-900 hover:bg-white">Lihat Detail Produk</a>
                 @endif
            </article>
            <div class="home-card home-surface rounded-3xl border border-brand-800/10 p-6 shadow-lg shadow-slate-900/10">
                <h3 class="text-xl font-bold text-slate-950">Informasi Produk</h3>
                 <p class="mt-4 leading-7 text-slate-600">{{ $homeProduct['detail_label'] ?? 'Informasi produk akan tersedia melalui database.' }}</p>
                <div class="mt-6 rounded-2xl bg-amber-50 p-5 text-sm leading-6 text-amber-900">Untuk detail manfaat, syarat, biaya, dan ketentuan, silakan hubungi kantor BPR pada jam layanan.</div>
            </div>
        </div>
    </div>
</section>

<section class="home-section-sage py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-bold uppercase tracking-widest text-brand-700">Pengurus</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Direksi dan Komisaris</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600 mx-auto">Informasi pengurus ditampilkan untuk mendukung transparansi profil PT BPR Karawang Jabar (Perseroda).</p>
        </div>
        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
            @if (count($homeManagement) === 0)
                <div class="sm:col-span-2 lg:col-span-4 rounded-3xl border border-dashed border-brand-800/20 bg-[#e9eee8] p-10 text-center">
                    <h3 class="text-xl font-bold text-slate-950">Data pengurus belum tersedia</h3>
                    <p class="mt-3 leading-7 text-slate-600">Informasi direksi dan komisaris akan ditampilkan setelah tersedia di database.</p>
                </div>
            @else
                @foreach (array_slice($homeManagement, 0, 4) as $person)
                <div class="home-card home-surface w-full max-w-sm rounded-3xl border border-brand-800/10 p-6 text-center shadow-lg shadow-slate-900/10" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"><div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-brand-100 text-lg font-bold text-brand-700">{{ $person['initials'] }}</div><p class="mt-5 font-bold text-slate-950">{{ $person['name'] }}</p><p class="mt-2 text-sm text-slate-500">{{ $person['position'] }}</p></div>
                @endforeach
            @endif
        </div>
        <div class="mt-10 text-center">
            <a href="{{ url('pengurus') }}" class="inline-flex items-center justify-center rounded-full border border-brand-800/15 bg-[#e9eee8] px-6 py-3 text-sm font-bold text-brand-900 hover:border-brand-700 hover:bg-[#dce6dc]">Lihat Halaman Pengurus</a>
        </div>
    </div>
</section>

<section class="bg-brand-900 py-16 text-white sm:py-20" data-aos="fade-up">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-brand-100">Kontak Cepat</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Butuh informasi layanan BPR?</h2>
            <p class="mt-4 max-w-2xl leading-7 text-brand-100">Hubungi {{ $jsonLdSettings['company_name'] }} melalui telepon, email, atau kunjungi kantor pada jam layanan.</p>
        </div>
        <div class="rounded-3xl border border-white/60 bg-[#f1eee4] p-6 text-slate-800 shadow-lg shadow-slate-900/10">
            <div class="space-y-4 text-sm">
                <div><p class="font-semibold text-slate-950">Telepon</p><p class="mt-1 text-slate-600">{{ $jsonLdSettings['phone'] }}</p></div>
                <div><p class="font-semibold text-slate-950">Email</p><p class="mt-1 break-all text-slate-600">{{ $jsonLdSettings['email'] }}</p></div>
                <div><p class="font-semibold text-slate-950">Jam Buka</p><p class="mt-1 text-slate-600">{{ $jsonLdSettings['office_hours'] }}</p></div>
            </div>
            <a href="{{ url('kontak') }}" class="inline-flex items-center justify-center rounded-full bg-brand-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-brand-900 mt-6 w-full">Ke Halaman Kontak</a>
        </div>
    </div>
</section>
</div>
@endsection
