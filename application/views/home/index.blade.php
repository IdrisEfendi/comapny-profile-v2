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

    @media (prefers-reduced-motion: reduce) {
        .hero-fade-up {
            opacity: 1;
            animation: none;
        }

        .hero-orb { animation: none; }
    }
</style>
@endsection

@section('content')
<section class="relative isolate overflow-hidden bg-slate-950">
    <div class="hero-orb absolute -left-40 -top-40 h-96 w-96 rounded-full bg-blue-700/20 blur-3xl"></div>
    <div class="hero-orb absolute -bottom-56 right-0 h-[30rem] w-[30rem] rounded-full bg-blue-500/10 blur-3xl" style="animation-delay: -4s;"></div>
    <div class="absolute inset-0 bg-[linear-gradient(135deg,#020617_0%,#0f172a_62%,#172554_100%)]"></div>
    <div class="relative mx-auto flex max-w-7xl items-center px-4 py-20 sm:px-6 sm:py-24 lg:min-h-[calc(100vh-7rem)] lg:px-8 lg:py-28">
        <div>
            <div class="hero-fade-up hero-delay-1 flex items-center gap-3 text-xs font-bold uppercase tracking-[0.22em] text-blue-200">
                <span class="h-px w-8 bg-amber-300"></span>
                <span>Profil Perusahaan</span>
            </div>
            <p class="hero-fade-up hero-delay-2 mt-7 max-w-xl text-sm font-semibold text-blue-200">{{ $jsonLdSettings['company_name'] }}</p>
            <h1 class="hero-fade-up hero-delay-2 mt-4 max-w-4xl text-5xl font-black leading-[1.04] tracking-[-0.035em] text-white sm:text-6xl lg:text-7xl">{{ $jsonLdSettings['tagline'] }}</h1>
            <p class="hero-fade-up hero-delay-3 mt-7 max-w-2xl text-base leading-8 text-slate-300 sm:text-lg">{{ $homeProfile['hero_intro'] }}</p>
            <div class="hero-fade-up hero-delay-4 mt-10 flex flex-col gap-3 sm:flex-row">
                <a href="{{ url('kontak') }}" class="inline-flex items-center justify-center rounded-2xl bg-amber-300 px-6 py-3.5 text-sm font-bold text-slate-950 shadow-lg shadow-amber-950/20 transition hover:bg-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-200 focus:ring-offset-2 focus:ring-offset-slate-950">Hubungi Kami</a>
                <a href="{{ url('produk-layanan') }}" class="inline-flex items-center justify-center rounded-2xl border border-white/20 bg-transparent px-6 py-3.5 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/10">Jelajahi Produk</a>
            </div>
        </div>

        <div class="relative hidden min-h-[32rem] lg:block">
            <div class="absolute right-10 top-8 h-64 w-64 rounded-full border border-blue-300/20"></div>
            <div class="absolute right-24 top-24 h-80 w-80 rounded-full border border-white/10"></div>
        </div>
    </div>
</section>

<section class="bg-white py-16 sm:py-20" data-aos="fade-up">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-[2rem] bg-blue-950 p-6 text-white shadow-2xl shadow-blue-950/20 sm:p-10 lg:p-12">
            <div class="grid gap-10 lg:grid-cols-[1fr_1.4fr] lg:items-end">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-blue-200">Informasi Kantor</p>
                    <h2 class="mt-4 text-3xl font-black tracking-tight sm:text-4xl">Hubungi {{ $jsonLdSettings['company_name'] }}</h2>
                    <p class="mt-4 max-w-xl leading-7 text-blue-100">Gunakan kanal resmi berikut untuk mendapatkan informasi layanan dan menghubungi kantor pada jam operasional.</p>
                    <a href="{{ url('kontak') }}" class="mt-7 inline-flex rounded-2xl bg-amber-300 px-6 py-3.5 text-sm font-bold text-slate-950 hover:bg-amber-200">Lihat Kontak Lengkap</a>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <a href="{{ public_phone_href($jsonLdSettings['phone']) }}" class="rounded-2xl border border-white/10 bg-white/[0.08] p-5 transition hover:bg-white/15">
                        <span class="text-xs font-bold uppercase tracking-widest text-blue-200">Telepon</span>
                        <span class="mt-2 block font-bold text-white">{{ $jsonLdSettings['phone'] }}</span>
                    </a>
                    <a href="mailto:{{ $jsonLdSettings['email'] }}" class="rounded-2xl border border-white/10 bg-white/[0.08] p-5 transition hover:bg-white/15">
                        <span class="text-xs font-bold uppercase tracking-widest text-blue-200">Email</span>
                        <span class="mt-2 block break-all font-bold text-white">{{ $jsonLdSettings['email'] }}</span>
                    </a>
                    <div class="rounded-2xl border border-white/10 bg-white/[0.08] p-5 sm:col-span-2">
                        <span class="text-xs font-bold uppercase tracking-widest text-blue-200">Alamat dan Jam Layanan</span>
                        <span class="mt-2 block font-bold text-white">{{ $jsonLdSettings['address'] }}</span>
                        <span class="mt-1 block text-sm text-blue-100">{{ $jsonLdSettings['office_hours'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-slate-100 py-20 sm:py-24" data-aos="fade-up">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Berita Terbaru</p>
                <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Informasi terbaru dari BPR</h2>
                <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Ikuti informasi dan pengumuman terbaru yang dipublikasikan melalui kanal resmi {{ $jsonLdSettings['company_name'] }}.</p>
            </div>
            <a href="{{ url('berita') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 hover:border-blue-700 hover:text-blue-800">Lihat Semua Berita</a>
        </div>

        @if (count($homeNews) === 0)
            <div class="mt-10 rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center">
                <h3 class="text-xl font-bold text-slate-950">Belum ada berita terbaru</h3>
                <p class="mt-3 leading-7 text-slate-600">Informasi dan pengumuman akan ditampilkan setelah tersedia di database.</p>
            </div>
        @else
            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ($homeNews as $item)
                    <article class="flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/10" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @if (! empty($item['image_path']))
                            <img src="{{ asset($item['image_path']) }}" alt="{{ $item['title'] }}" class="h-48 w-full object-cover">
                        @else
                            <div class="flex h-48 items-center justify-center bg-gradient-to-br from-blue-900 to-blue-700 text-4xl font-black text-white">{{ strtoupper(substr($item['title'], 0, 1)) }}</div>
                        @endif
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex flex-wrap items-center gap-3 text-xs font-semibold text-blue-700">
                                @if ($item['category'] !== '')
                                    <span>{{ $item['category'] }}</span>
                                @endif
                                @if (public_format_date($item['published_at']) !== '')
                                    <span class="text-slate-500">{{ public_format_date($item['published_at']) }}</span>
                                @endif
                            </div>
                            <h3 class="mt-4 text-xl font-bold leading-tight text-slate-950">{{ $item['title'] }}</h3>
                            <p class="mt-3 line-clamp-3 flex-1 leading-7 text-slate-600">{{ $item['summary'] }}</p>
                            <a href="{{ url('berita/'.$item['slug']) }}" class="mt-6 inline-flex self-start rounded-full bg-blue-800 px-5 py-2.5 text-sm font-bold text-white hover:bg-blue-950">Baca Berita</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="py-20 sm:py-24" data-aos="fade-up">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-12 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Tentang Kami</p>
             <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">{{ $homeProfile['profile_heading'] }}</h2>
             <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">{{ $homeProfile['profile_summary'] }}</p>
            <a href="{{ url('tentang-kami') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950 mt-8">Pelajari Profil</a>
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">01</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Lokal & Dekat</h3>
                 <p class="mt-3 text-sm leading-6 text-slate-600">{{ $homeProfile['area_service'] }}</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">02</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Informasi Terbuka</h3>
                 <p class="mt-3 text-sm leading-6 text-slate-600">{{ $homeProfile['information_focus'] }}</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">03</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Mudah Dihubungi</h3>
                 <p class="mt-3 text-sm leading-6 text-slate-600">{{ $homeProduct['detail_label'] ?? 'Hubungi kantor untuk informasi lebih lanjut.' }}</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">04</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Siap Dikembangkan</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Struktur website disiapkan agar mudah dikembangkan ke produk, berita, atau form pengajuan.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Produk Unggulan</p>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Produk & Layanan</h2>
                 <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">{{ $homeProduct ? $homeProduct['summary'] : 'Informasi produk akan tersedia melalui database.' }}</p>
            </div>
            <a href="{{ url('produk-layanan') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 hover:border-blue-700 hover:text-blue-800">Lihat Semua Produk</a>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            <article class="rounded-3xl border border-slate-200 bg-gradient-to-br from-blue-900 to-blue-700 p-8 text-white shadow-lg shadow-slate-900/10">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-xl font-bold text-blue-800">T</div>
                 <p class="mt-8 text-sm font-semibold text-blue-100">{{ $homeProduct['subtitle'] ?? 'Produk dan layanan' }}</p>
                 <h3 class="mt-2 text-3xl font-bold">{{ $homeProduct['name'] ?? 'Produk' }}</h3>
                 <p class="mt-4 max-w-2xl leading-7 text-blue-50">{{ $homeProduct['summary'] ?? 'Belum ada produk unggulan.' }}</p>
                 @if ($homeProduct)
                     <a href="{{ url('produk/'.$homeProduct['slug']) }}" class="mt-8 inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-900 hover:bg-blue-50">Lihat Detail Produk</a>
                 @endif
            </article>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <h3 class="text-xl font-bold text-slate-950">Informasi Produk</h3>
                 <p class="mt-4 leading-7 text-slate-600">{{ $homeProduct['detail_label'] ?? 'Informasi produk akan tersedia melalui database.' }}</p>
                <div class="mt-6 rounded-2xl bg-amber-50 p-5 text-sm leading-6 text-amber-900">Untuk detail manfaat, syarat, biaya, dan ketentuan, silakan hubungi kantor BPR pada jam layanan.</div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Pengurus</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">Direksi dan Komisaris</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600 mx-auto">Informasi pengurus ditampilkan untuk mendukung transparansi profil PT BPR Karawang Jabar (Perseroda).</p>
        </div>
        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
            @if (count($homeManagement) === 0)
                <div class="sm:col-span-2 lg:col-span-4 rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center">
                    <h3 class="text-xl font-bold text-slate-950">Data pengurus belum tersedia</h3>
                    <p class="mt-3 leading-7 text-slate-600">Informasi direksi dan komisaris akan ditampilkan setelah tersedia di database.</p>
                </div>
            @else
                @foreach (array_slice($homeManagement, 0, 4) as $person)
                <div class="w-full max-w-sm rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-lg shadow-slate-900/10" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"><div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-lg font-bold text-blue-700">{{ $person['initials'] }}</div><p class="mt-5 font-bold text-slate-950">{{ $person['name'] }}</p><p class="mt-2 text-sm text-slate-500">{{ $person['position'] }}</p></div>
                @endforeach
            @endif
        </div>
        <div class="mt-10 text-center">
            <a href="{{ url('pengurus') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 hover:border-blue-700 hover:text-blue-800">Lihat Halaman Pengurus</a>
        </div>
    </div>
</section>

<section class="bg-blue-900 py-16 text-white sm:py-20" data-aos="fade-up">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Kontak Cepat</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Butuh informasi layanan BPR?</h2>
            <p class="mt-4 max-w-2xl leading-7 text-blue-100">Hubungi {{ $jsonLdSettings['company_name'] }} melalui telepon, email, atau kunjungi kantor pada jam layanan.</p>
        </div>
        <div class="rounded-3xl bg-white p-6 text-slate-800 shadow-lg shadow-slate-900/10">
            <div class="space-y-4 text-sm">
                <div><p class="font-semibold text-slate-950">Telepon</p><p class="mt-1 text-slate-600">{{ $jsonLdSettings['phone'] }}</p></div>
                <div><p class="font-semibold text-slate-950">Email</p><p class="mt-1 break-all text-slate-600">{{ $jsonLdSettings['email'] }}</p></div>
                <div><p class="font-semibold text-slate-950">Jam Buka</p><p class="mt-1 text-slate-600">{{ $jsonLdSettings['office_hours'] }}</p></div>
            </div>
            <a href="{{ url('kontak') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950 mt-6 w-full">Ke Halaman Kontak</a>
        </div>
    </div>
</section>
@endsection
