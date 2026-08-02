@layout('layouts.app')

@php
    $settings = public_settings();
    $news = public_news();
    $date = public_format_date($item['published_at']);
    $otherNews = array_values(array_filter($news, function ($n) use ($item) {
        return $n['slug'] !== $item['slug'];
    }));
@endphp

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-amber-50 via-white to-blue-50 py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Berita & Pengumuman</p>
            <h1 class="mt-5 max-w-4xl text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl">{{ $item['title'] }}</h1>
            <div class="mt-6 flex flex-wrap items-center gap-3">
                @if ($item['category'] !== '')
                    <span class="rounded-full bg-blue-800 px-3 py-1 text-xs font-semibold text-white">{{ $item['category'] }}</span>
                @endif
                @if ($date !== '')
                    <span class="text-sm font-semibold text-slate-500">{{ $date }}</span>
                @endif
            </div>
            @if ($item['summary'] !== '')
                <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-600">{{ $item['summary'] }}</p>
            @endif
            <a href="{{ url('berita') }}" class="mt-8 inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 hover:border-blue-700 hover:text-blue-800">Kembali ke Berita</a>
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-8 lg:grid-cols-3">
        <div class="space-y-8 lg:col-span-2">
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 sm:p-10">
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">{{ $item['title'] }}</h2>
                <div class="mt-6 whitespace-pre-line leading-8 text-slate-700">{{ $item['content'] }}</div>
            </article>

            <div class="rounded-3xl border border-blue-100 bg-blue-50 p-6">
                <h3 class="text-xl font-bold text-slate-950">Butuh informasi lebih lanjut?</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Hubungi {{ $settings['company_name'] }} melalui kanal kontak resmi untuk mendapatkan informasi terbaru dan akurat.</p>
                <a href="{{ url('kontak') }}" class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950">Hubungi Kami</a>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <h3 class="text-xl font-bold text-slate-950">Berita lainnya</h3>
                @if (count($otherNews) === 0)
                    <p class="mt-4 text-sm leading-6 text-slate-600">Belum ada berita lain.</p>
                @else
                    <ul class="mt-5 space-y-4">
                        @foreach ($otherNews as $other)
                            <li>
                                <a href="{{ url('berita/'.$other['slug']) }}" class="block rounded-2xl bg-slate-50 p-4 transition hover:bg-blue-50">
                                    @if ($other['category'] !== '')
                                        <span class="text-xs font-semibold text-blue-700">{{ $other['category'] }}</span>
                                    @endif
                                    <p class="mt-1 font-bold leading-snug text-slate-950">{{ $other['title'] }}</p>
                                    @if (public_format_date($other['published_at']) !== '')
                                        <p class="mt-1 text-xs text-slate-500">{{ public_format_date($other['published_at']) }}</p>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="rounded-3xl border border-amber-200 bg-amber-50 p-6">
                <h3 class="font-bold text-amber-950">Informasi resmi</h3>
                <p class="mt-3 text-sm leading-6 text-amber-900">Untuk informasi resmi terkait layanan dan pengumuman BPR, silakan konfirmasi langsung melalui kanal kontak resmi.</p>
            </div>
        </aside>
    </div>
</section>
@endsection
