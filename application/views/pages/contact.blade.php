@layout('layouts.app')

@section('content')
<section class="bg-gradient-to-br from-blue-950 via-blue-900 to-slate-950 py-20 text-white sm:py-24">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8 lg:items-end">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Kontak</p>
            <h1 class="mt-5 max-w-4xl text-4xl font-bold tracking-tight sm:text-5xl">Hubungi PT BPR Karawang Jabar</h1>
            <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-300">Temukan informasi alamat, telepon, email, dan jam layanan PT BPR Karawang Jabar (Perseroda).</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/10 p-6 backdrop-blur">
            <p class="text-sm font-semibold text-blue-100">Jam Layanan</p>
            <p class="mt-2 text-3xl font-bold text-white">08:00 - 14:00</p>
            <p class="mt-2 leading-7 text-slate-300">Senin sampai Jumat</p>
        </div>
    </div>
</section>

<section class="py-20 sm:py-24">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div class="space-y-6">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Informasi Kontak</p>
                <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Kanal resmi yang tersedia</h2>
                <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Gunakan kanal berikut untuk menghubungi PT BPR Karawang Jabar (Perseroda) pada jam layanan.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">☎</div>
                    <h3 class="mt-5 font-bold text-slate-950">Telepon</h3>
                    <p class="mt-2 text-slate-600">(0264) 8380203</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">✉</div>
                    <h3 class="mt-5 font-bold text-slate-950">Email</h3>
                    <p class="mt-2 break-all text-slate-600">ptbptkarawang@gmail.com</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 sm:col-span-2">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">⌂</div>
                    <h3 class="mt-5 font-bold text-slate-950">Alamat Kantor</h3>
                    <p class="mt-2 leading-7 text-slate-600">Jln Raya Cilamaya Komplek Kantor Kecamatan Cilamaya Wetan</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 sm:col-span-2">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">⏱</div>
                    <h3 class="mt-5 font-bold text-slate-950">Jam Buka</h3>
                    <p class="mt-2 text-slate-600">Senin - Jumat, 08:00 - 14:00</p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/10 sm:p-8">
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Form Kontak</p>
            <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Kirim pesan</h2>
            <p class="mt-3 text-sm leading-6 text-slate-600">Isi pesan Anda, lalu gunakan kanal telepon atau email resmi untuk menghubungi BPR. Integrasi pengiriman pesan dapat ditambahkan pada tahap berikutnya.</p>

            <form class="mt-8 space-y-5" action="mailto:ptbptkarawang@gmail.com" method="post" enctype="text/plain">
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="name">Nama</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="name" name="name" type="text" placeholder="Nama lengkap">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="contact">Email / Telepon</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="contact" name="contact" type="text" placeholder="email@domain.com / nomor telepon">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="subject">Subjek</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="subject" name="subject" type="text" placeholder="Informasi produk">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="message">Pesan</label>
                    <textarea class="mt-2 min-h-32 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="message" name="message" placeholder="Tulis pesan Anda"></textarea>
                </div>
                <button class="inline-flex w-full items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Kirim via Email</button>
            </form>
        </div>
    </div>
</section>

<section class="bg-white py-20 sm:py-24">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:px-8 lg:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Lokasi</p>
            <h2 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-950 sm:text-3xl">Kantor BPR Karawang Jabar</h2>
            <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">Embed Google Maps dapat ditambahkan setelah link lokasi resmi tersedia. Untuk saat ini, alamat ditampilkan dalam bentuk teks agar tidak keliru.</p>
        </div>
        <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-2xl text-blue-700">⌖</div>
            <h3 class="mt-5 text-xl font-bold text-slate-950">Lokasi Kantor</h3>
            <p class="mt-3 leading-7 text-slate-600">Alamat kantor dapat digunakan sebagai acuan lokasi. Peta interaktif dapat ditambahkan saat link Google Maps resmi sudah siap.</p>
        </div>
    </div>
</section>

<section class="bg-blue-900 py-16 text-white sm:py-20">
    <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-200">Butuh informasi cepat?</p>
            <h2 class="mt-3 text-3xl font-bold tracking-tight">Hubungi kantor pada jam layanan</h2>
            <p class="mt-3 max-w-2xl text-blue-100">Untuk informasi produk dan layanan, gunakan telepon atau email resmi yang tersedia.</p>
        </div>
        <a href="tel:02648380203" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-blue-900 hover:bg-blue-50">Telepon Sekarang</a>
    </div>
</section>
@endsection
