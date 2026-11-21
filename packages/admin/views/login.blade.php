<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - BPR Karawang Jabar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: '#102b35',
                        forest: '#173f46',
                        gold: '#f0c66f',
                        paper: '#f5f4ef'
                    }
                }
            }
        };
    </script>
</head>
<body class="min-h-screen bg-paper font-sans text-slate-900 antialiased">
    <main class="grid min-h-screen lg:grid-cols-[1.05fr_0.95fr]">
        <section class="relative isolate flex min-h-[320px] flex-col justify-between overflow-hidden bg-ink px-7 py-8 text-white sm:px-12 sm:py-10 lg:min-h-screen lg:px-16 lg:py-14">
            <div aria-hidden="true" class="absolute -right-32 -top-40 -z-10 h-[32rem] w-[32rem] rounded-full border border-white/10"></div>
            <div aria-hidden="true" class="absolute -right-16 -top-24 -z-10 h-[24rem] w-[24rem] rounded-full border border-white/10"></div>
            <div aria-hidden="true" class="absolute -bottom-48 -left-20 -z-10 h-[30rem] w-[30rem] rounded-full bg-gold/10 blur-3xl"></div>

            <a class="inline-flex w-fit items-center gap-3 rounded-full focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-4 focus-visible:ring-offset-[#102b35]" href="{{ url('/') }}" aria-label="BPR Karawang Jabar, kembali ke halaman utama">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/15 bg-white/10 text-sm font-black tracking-wide text-[#f0c66f]">BPR</span>
                <span class="leading-tight"><span class="block text-sm font-semibold tracking-wide">BPR Karawang Jabar</span><span class="mt-1 block text-xs text-white/60">Perseroda</span></span>
            </a>

            <div class="max-w-xl py-10 lg:py-0">
                <p class="mb-5 flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.24em] text-gold"><span class="h-px w-8 bg-gold"></span>Portal pengelolaan</p>
                <h1 class="max-w-lg text-4xl font-semibold leading-[1.12] tracking-tight sm:text-5xl lg:text-6xl">Melayani Karawang, <span class="font-serif italic font-normal text-gold">bertumbuh</span> bersama.</h1>
                <p class="mt-6 max-w-md text-sm leading-7 text-white/70 sm:text-base">Kelola informasi dan cerita perusahaan melalui satu ruang kerja yang aman.</p>
            </div>

            <div class="flex items-center justify-between border-t border-white/15 pt-5 text-xs text-white/50">
                <span>PT BPR Karawang Jabar (Perseroda)</span>
                <span class="hidden sm:inline">Mitra Keuangan Masyarakat Karawang</span>
            </div>
        </section>

        <section class="flex items-center justify-center px-6 py-12 sm:px-12 lg:px-16">
            <div class="w-full max-w-md">
                <div class="mb-10">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#9a742b]">Akses administrator</p>
                    <h2 class="mt-3 text-3xl font-semibold tracking-tight text-[#172b31] sm:text-4xl">Selamat datang</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Masuk dengan akun admin untuk melanjutkan ke dashboard.</p>
                </div>

                @if (! empty($error))
                    <div class="mb-6 flex gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm leading-6 text-red-800" role="alert">
                        <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.5a.75.75 0 0 0-1.5 0v4a.75.75 0 0 0 1.5 0v-4ZM10 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                        <span>{{ $error }}</span>
                    </div>
                @endif

                <form action="{{ url('admin/login') }}" method="post" class="space-y-5">
                    @php echo csrf_field(); @endphp
                    <div class="space-y-1">
                        <label class="mb-2 block text-sm font-semibold text-[#263c41]" for="username">Username</label>
                        <input class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-forest focus:ring-4 focus:ring-forest/10" id="username" name="username" type="text" autocomplete="username" autocapitalize="none" spellcheck="false" placeholder="Masukkan username" required>
                    </div>
                    <div class="space-y-1">
                        <label class="mb-2 block text-sm font-semibold text-[#263c41]" for="password">Password</label>
                        <input class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-forest focus:ring-4 focus:ring-forest/10" id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan password" required>
                    </div>
                    <button class="group mt-2 inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-forest px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-forest/20 transition hover:bg-ink focus:outline-none focus-visible:ring-4 focus-visible:ring-forest/25 active:translate-y-px" type="submit">
                        Masuk ke dashboard
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.69L10.22 5.03a.75.75 0 1 1 1.06-1.06l5.5 5.5a.75.75 0 0 1 0 1.06l-5.5 5.5a.75.75 0 0 1-1.06-1.06l4.22-4.22H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd"/></svg>
                    </button>
                </form>

                <div class="mt-8 flex items-start gap-3 border-t border-[#e2e4de] pt-5 text-xs leading-5 text-slate-500">
                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#9a742b]" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 1.75a.75.75 0 0 1 .372.099l6 3.375a.75.75 0 0 1 .378.654v4.247c0 3.69-2.255 6.976-6.473 8.092a1.04 1.04 0 0 1-.554 0C5.505 17.101 3.25 13.815 3.25 10.125V5.878a.75.75 0 0 1 .378-.654l6-3.375A.75.75 0 0 1 10 1.75Zm2.28 6.72a.75.75 0 0 0-1.06-1.06l-2.03 2.03-.91-.91a.75.75 0 0 0-1.06 1.06l1.44 1.44a.75.75 0 0 0 1.06 0l2.56-2.56Z" clip-rule="evenodd"/></svg>
                    <p>Akses terbatas untuk administrator yang berwenang. Kredensial dikelola melalui konfigurasi lingkungan.</p>
                </div>
                <p class="mt-8 text-center text-xs text-slate-400">&copy; {{ date('Y') }} BPR Karawang Jabar</p>
            </div>
        </section>
    </main>
</body>
</html>
