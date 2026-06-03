@layout('layouts.app')

@php
    $settings = public_settings();
    $phoneHref = public_phone_href($settings['phone']);
    $whatsappHref = public_whatsapp_href($settings['whatsapp']);
    $mapsUrl = public_safe_url($settings['google_maps_url']);
@endphp

@section('content')
<section class="bg-gradient-to-br from-blue-950 via-blue-900 to-slate-950 py-20 text-white sm:py-24">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8 lg:items-end">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Kontak</p>
            <h1 class="mt-5 max-w-4xl text-4xl font-bold tracking-tight sm:text-5xl">Hubungi {{ $settings['company_name'] }}</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-300">Temukan informasi alamat, telepon, email, dan jam layanan {{ $settings['company_name'] }}.</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
            <p class="text-sm font-semibold text-blue-100">Jam Layanan</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ $settings['office_hours'] }}</p>
            <p class="mt-2 leading-7 text-slate-300">Silakan hubungi kanal resmi pada jam layanan.</p>
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div class="space-y-6">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Informasi Kontak</p>
                <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Kanal resmi yang tersedia</h2>
                <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Gunakan kanal berikut untuk menghubungi {{ $settings['company_name'] }} pada jam layanan.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">☎</div>
                    <h3 class="mt-5 font-bold text-slate-950">Telepon</h3>
                    <p class="mt-2 text-slate-600"><a class="hover:text-blue-700" href="{{ $phoneHref }}">{{ $settings['phone'] }}</a></p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">✉</div>
                    <h3 class="mt-5 font-bold text-slate-950">Email</h3>
                    <p class="mt-2 break-all text-slate-600"><a class="hover:text-blue-700" href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 sm:col-span-2">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">⌂</div>
                    <h3 class="mt-5 font-bold text-slate-950">Alamat Kantor</h3>
                    <p class="mt-2 leading-7 text-slate-600">{{ $settings['address'] }}</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 sm:col-span-2">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">⏱</div>
                    <h3 class="mt-5 font-bold text-slate-950">Jam Buka</h3>
                    <p class="mt-2 text-slate-600">{{ $settings['office_hours'] }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 sm:p-8">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Form Kontak</p>
            <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Kirim pesan</h2>
            <p class="mt-3 text-sm leading-6 text-slate-600">Isi pesan Anda, lalu pesan akan tersimpan dan dapat ditindaklanjuti oleh admin website.</p>

            @if (! empty($success))
                <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ $success }}</div>
            @endif

            @if (! empty($error))
                <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">{{ $error }}</div>
            @endif

            <form class="mt-8 space-y-5" action="{{ url('kontak') }}" method="post">
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="name">Nama</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="name" name="name" type="text" placeholder="Nama lengkap" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="contact">Email / Telepon</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="contact" name="contact" type="text" placeholder="email@domain.com / nomor telepon" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="subject">Subjek</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="subject" name="subject" type="text" placeholder="Informasi produk">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="message">Pesan</label>
                    <textarea class="mt-2 min-h-32 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="message" name="message" placeholder="Tulis pesan Anda" required></textarea>
                </div>
                <button class="inline-flex w-full items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Kirim Pesan</button>
            </form>
        </div>
    </div>
</section>

<section class="bg-white py-20 sm:py-24">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:px-8 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Lokasi</p>
            <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Kantor BPR Karawang Jabar</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">{{ $mapsUrl ? 'Gunakan tautan Google Maps resmi untuk melihat lokasi kantor.' : 'Embed Google Maps dapat ditambahkan setelah link lokasi resmi tersedia. Untuk saat ini, alamat ditampilkan dalam bentuk teks agar tidak keliru.' }}</p>
        </div>
        <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-2xl text-blue-700">⌖</div>
            <h3 class="mt-5 text-xl font-bold text-slate-950">Lokasi Kantor</h3>
            <p class="mt-3 leading-7 text-slate-600">{{ $settings['address'] }}</p>
            @if ($mapsUrl)
                <a href="{{ $mapsUrl }}" target="_blank" rel="noopener" class="mt-5 inline-flex rounded-full bg-blue-800 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-950">Buka Google Maps</a>
            @else
                <p class="mt-3 text-sm leading-6 text-slate-500">Peta interaktif dapat ditambahkan saat link Google Maps resmi sudah siap.</p>
            @endif
        </div>
    </div>
</section>

<section class="bg-blue-900 py-16 text-white sm:py-20">
    <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Butuh informasi cepat?</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight">Hubungi kantor pada jam layanan</h2>
            <p class="mt-3 max-w-2xl text-blue-100">Untuk informasi produk dan layanan, gunakan telepon, email, atau WhatsApp resmi yang tersedia.</p>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row">
            @if ($whatsappHref)
                <a href="{{ $whatsappHref }}" target="_blank" rel="noopener" class="inline-flex rounded-full bg-amber-400 px-6 py-3 text-sm font-semibold text-slate-950 hover:bg-amber-300">WhatsApp</a>
            @endif
            <a href="{{ $phoneHref }}" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-900 hover:bg-blue-50">Telepon Sekarang</a>
        </div>
    </div>
</section>
@endsection
