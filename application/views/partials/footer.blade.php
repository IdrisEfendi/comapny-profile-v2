<footer class="border-t border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 py-12 md:grid-cols-4">
        <div class="md:col-span-2">
            <div class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-700 text-sm font-bold text-white">BPR</span>
                <div>
                    <p class="font-bold text-slate-950">PT BPR Karawang Jabar (Perseroda)</p>
                    <p class="text-sm text-slate-500">Mitra Keuangan Masyarakat Karawang</p>
                </div>
            </div>
            <p class="mt-5 max-w-xl text-sm leading-6 text-slate-600">
                Media informasi digital untuk memperkenalkan profil, produk, pengurus, dan kanal kontak PT BPR Karawang Jabar (Perseroda) secara jelas dan mudah diakses.
            </p>
        </div>

        <div>
            <h3 class="font-semibold text-slate-950">Menu</h3>
            <ul class="mt-4 space-y-2 text-sm text-slate-600">
                <li><a class="hover:text-blue-700" href="{{ url('tentang-kami') }}">Tentang Kami</a></li>
                <li><a class="hover:text-blue-700" href="{{ url('produk-layanan') }}">Produk & Layanan</a></li>
                <li><a class="hover:text-blue-700" href="{{ url('pengurus') }}">Pengurus</a></li>
                <li><a class="hover:text-blue-700" href="{{ url('kontak') }}">Kontak</a></li>
            </ul>
        </div>

        <div>
            <h3 class="font-semibold text-slate-950">Kontak</h3>
            <ul class="mt-4 space-y-2 text-sm leading-6 text-slate-600">
                <li>Jln Raya Cilamaya Komplek Kantor Kecamatan Cilamaya Wetan</li>
                <li>(0264) 8380203</li>
                <li>ptbptkarawang@gmail.com</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-slate-200 py-5">
        <p class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-sm text-slate-500">© {{ date('Y') }} PT BPR Karawang Jabar (Perseroda). All rights reserved.</p>
    </div>
</footer>
