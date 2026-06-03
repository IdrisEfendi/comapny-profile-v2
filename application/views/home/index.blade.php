@layout('layouts.app')

@section('content')
<section class="relative overflow-hidden bg-slate-950">
    <div class="absolute inset-0 bg-blue-900/20"></div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative grid min-h-screen items-center gap-12 py-20 lg:grid-cols-2 lg:py-24">
        <div>
            <p class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-semibold text-blue-100 backdrop-blur">PT BPR Karawang Jabar (Perseroda)</p>
            <h1 class="mt-7 max-w-4xl text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">Mitra Keuangan Masyarakat Karawang</h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">Media informasi digital PT BPR Karawang Jabar (Perseroda) yang membantu masyarakat mengenal profil perusahaan, produk layanan, pengurus, dan kanal kontak resmi dengan lebih mudah.</p>
            <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                <a href="{{ url('kontak') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-900 shadow-lg shadow-slate-900/10 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-slate-950">Hubungi Kami</a>
                <a href="{{ url('produk-layanan') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 px-6 py-3 text-sm font-semibold text-white hover:border-white/40 hover:bg-white/10">Lihat Produk</a>
            </div>
            <div class="mt-10 grid max-w-2xl gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                    <p class="text-2xl font-bold text-white">08:00</p>
                    <p class="mt-1 text-sm text-slate-300">Mulai layanan</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                    <p class="text-2xl font-bold text-white">TAHARA</p>
                    <p class="mt-1 text-sm text-slate-300">Produk awal</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                    <p class="text-2xl font-bold text-white">Karawang</p>
                    <p class="mt-1 text-sm text-slate-300">Area layanan</p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-white/10 bg-white/10 p-4 shadow-2xl backdrop-blur">
            <div class="rounded-3xl bg-white p-6 sm:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-blue-700">Informasi Kantor</p>
                        <h2 class="mt-2 text-2xl font-bold text-slate-950">BPR Karawang Jabar</h2>
                    </div>
                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Aktif</span>
                </div>

                <div class="mt-8 space-y-4">
                    <div class="rounded-2xl bg-slate-50 p-5">
                        <p class="text-sm font-semibold text-slate-500">Jam Layanan</p>
                        <p class="mt-1 text-lg font-bold text-slate-950">Senin - Jumat, 08:00 - 14:00</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-5">
                        <p class="text-sm font-semibold text-slate-500">Telepon</p>
                        <p class="mt-1 text-lg font-bold text-slate-950">(0264) 8380203</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-5">
                        <p class="text-sm font-semibold text-slate-500">Email</p>
                        <p class="mt-1 break-all text-lg font-bold text-slate-950">ptbptkarawang@gmail.com</p>
                    </div>
                    <div class="rounded-2xl bg-blue-50 p-5">
                        <p class="text-sm font-semibold text-blue-700">Alamat</p>
                        <p class="mt-1 leading-6 text-slate-700">Jln Raya Cilamaya Komplek Kantor Kecamatan Cilamaya Wetan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-12 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Tentang Kami</p>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl mt-3">BPR daerah yang dekat dengan masyarakat Karawang</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">PT BPR Karawang Jabar (Perseroda) hadir sebagai lembaga keuangan daerah yang menyediakan informasi layanan secara terbuka, mudah dipahami, dan mudah dihubungi.</p>
            <a href="{{ url('tentang-kami') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950 mt-8">Pelajari Profil</a>
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">01</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Lokal & Dekat</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Berorientasi pada kebutuhan masyarakat Karawang dan area sekitar Cilamaya.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">02</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Informasi Terbuka</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Pengurus, produk awal, alamat, telepon, email, dan jam layanan ditampilkan jelas.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">03</div>
                <h3 class="mt-5 text-lg font-bold text-slate-950">Mudah Dihubungi</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600">Pengunjung diarahkan ke kanal kontak resmi untuk memperoleh informasi lebih lanjut.</p>
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
                <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">TAHARA atau Tabungan Hari Raya menjadi produk yang ditampilkan pada website ini. Informasi lebih lanjut dapat diperoleh melalui kanal kontak resmi BPR.</p>
            </div>
            <a href="{{ url('produk-layanan') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 hover:border-blue-700 hover:text-blue-800">Lihat Semua Produk</a>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            <article class="rounded-3xl border border-slate-200 bg-gradient-to-br from-blue-900 to-blue-700 p-8 text-white shadow-lg shadow-slate-900/10">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-xl font-bold text-blue-800">T</div>
                <p class="mt-8 text-sm font-semibold text-blue-100">Tabungan Hari Raya</p>
                <h3 class="mt-2 text-3xl font-bold">TAHARA</h3>
                <p class="mt-4 max-w-2xl leading-7 text-blue-50">Produk tabungan untuk membantu perencanaan kebutuhan hari raya. Halaman detail disiapkan dengan bahasa aman sampai syarat dan manfaat resmi tersedia.</p>
                <a href="{{ url('produk/tahara') }}" class="mt-8 inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-900 hover:bg-blue-50">Lihat Detail Produk</a>
            </article>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                <h3 class="text-xl font-bold text-slate-950">Informasi Produk</h3>
                <p class="mt-4 leading-7 text-slate-600">Informasi produk keuangan disajikan secara ringkas dan hati-hati agar pengunjung mendapatkan arahan yang jelas sebelum menghubungi BPR.</p>
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
        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 text-center"><div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-lg font-bold text-blue-700">HH</div><p class="mt-5 font-bold text-slate-950">Heri Heryanto SH, MM</p><p class="mt-2 text-sm text-slate-500">Direktur Utama</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 text-center"><div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-lg font-bold text-blue-700">AH</div><p class="mt-5 font-bold text-slate-950">Atjeng Hadis Susanto SE</p><p class="mt-2 text-sm text-slate-500">Direktur</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 text-center"><div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-lg font-bold text-blue-700">JS</div><p class="mt-5 font-bold text-slate-950">Jaja Sumarna SE</p><p class="mt-2 text-sm text-slate-500">Komisaris Utama</p></div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 text-center"><div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-lg font-bold text-blue-700">DK</div><p class="mt-5 font-bold text-slate-950">Dikdik Kustiadi</p><p class="mt-2 text-sm text-slate-500">Komisaris</p></div>
        </div>
        <div class="mt-10 text-center">
            <a href="{{ url('pengurus') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-bold text-slate-700 hover:border-blue-700 hover:text-blue-800">Lihat Halaman Pengurus</a>
        </div>
    </div>
</section>

<section class="bg-blue-900 py-16 text-white sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Kontak Cepat</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Butuh informasi layanan BPR?</h2>
            <p class="mt-4 max-w-2xl leading-7 text-blue-100">Hubungi PT BPR Karawang Jabar (Perseroda) melalui telepon, email, atau kunjungi kantor pada jam layanan.</p>
        </div>
        <div class="rounded-3xl bg-white p-6 text-slate-800 shadow-lg shadow-slate-900/10">
            <div class="space-y-4 text-sm">
                <div><p class="font-semibold text-slate-950">Telepon</p><p class="mt-1 text-slate-600">(0264) 8380203</p></div>
                <div><p class="font-semibold text-slate-950">Email</p><p class="mt-1 break-all text-slate-600">ptbptkarawang@gmail.com</p></div>
                <div><p class="font-semibold text-slate-950">Jam Buka</p><p class="mt-1 text-slate-600">Senin - Jumat, 08:00 - 14:00</p></div>
            </div>
            <a href="{{ url('kontak') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950 mt-6 w-full">Ke Halaman Kontak</a>
        </div>
    </div>
</section>
@endsection
