@layout('layouts.app')

@php
    $news = public_news();
@endphp

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-blue-950 via-blue-900 to-slate-950 py-20 text-white sm:py-24">
    <div class="absolute inset-0 bg-blue-900/20"></div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
        <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Berita & Pengumuman</p>
        <h1 class="mt-5 max-w-4xl text-4xl font-bold tracking-tight sm:text-5xl">Informasi terbaru dari BPR</h1>
        <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-300">Halaman ini menampilkan berita dan pengumuman PT BPR Karawang Jabar (Perseroda) yang dikelola dari admin panel.</p>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if (count($news) === 0)
            <div class="mx-auto max-w-2xl rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-lg shadow-slate-900/10">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-2xl font-bold text-blue-700">!</div>
                <h2 class="mt-6 text-2xl font-bold tracking-tight text-slate-950">Belum ada berita</h2>
                <p class="mt-3 leading-7 text-slate-600">Informasi berita dan pengumuman akan ditampilkan di halaman ini setelah tersedia.</p>
                <a href="{{ url('kontak') }}" class="mt-8 inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950">Hubungi Kami</a>
            </div>
        @else
            <div class="grid gap-8 lg:grid-cols-2">
                @foreach ($news as $item)
                    @php
                        $date = public_format_date($item['published_at']);
                        $detailUrl = url('berita/'.$item['slug']);
                    @endphp
                    <article class="flex flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/10">
                        <div class="bg-gradient-to-br from-blue-900 to-blue-700 p-8 text-white">
                            <div class="flex flex-wrap items-center gap-3">
                                @if ($item['category'] !== '')
                                    <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-blue-50">{{ $item['category'] }}</span>
                                @endif
                                @if ($date !== '')
                                    <span class="text-sm text-blue-100">{{ $date }}</span>
                                @endif
                            </div>
                            <h3 class="mt-4 text-2xl font-bold leading-tight">{{ $item['title'] }}</h3>
                            <p class="mt-4 leading-7 text-blue-50">{{ $item['summary'] }}</p>
                        </div>
                        <div class="mt-auto border-t border-slate-200 px-8 py-6">
                            <a href="{{ $detailUrl }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950">Baca Selengkapnya</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="bg-blue-900 py-16 text-white sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Punya Pertanyaan?</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight">Hubungi kantor BPR pada jam layanan</h2>
            <p class="mt-3 max-w-2xl text-blue-100">Tim BPR dapat memberikan informasi resmi terkait layanan dan pengumuman yang sedang berjalan.</p>
        </div>
        <a href="{{ url('kontak') }}" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-900 hover:bg-blue-50">Hubungi Kami</a>
    </div>
</section>
@endsection
