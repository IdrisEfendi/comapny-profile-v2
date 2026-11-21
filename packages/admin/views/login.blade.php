<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - BPR Karawang Jabar</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .admin-login-page { background: #f5f4ef; color: #172b31; }
        .admin-login-layout { display: grid; min-height: 100vh; }
        .admin-login-brand { position: relative; isolation: isolate; display: flex; min-height: 320px; flex-direction: column; justify-content: space-between; overflow: hidden; background: #102b35; padding: 2rem 1.75rem; color: #fff; }
        .admin-login-brand:before, .admin-login-brand:after { position: absolute; z-index: -1; content: ""; border: 1px solid rgba(255,255,255,.1); border-radius: 9999px; }
        .admin-login-brand:before { top: -10rem; right: -8rem; width: 32rem; height: 32rem; }
        .admin-login-brand:after { top: -6rem; right: -4rem; width: 24rem; height: 24rem; }
        .admin-login-orb { position: absolute; z-index: -1; bottom: -12rem; left: -5rem; width: 30rem; height: 30rem; border-radius: 9999px; background: rgba(214,166,75,.1); filter: blur(48px); }
        .admin-login-content { display: flex; align-items: center; justify-content: center; padding: 3rem 1.5rem; }
        .admin-login-form { width: 100%; max-width: 28rem; }
        .admin-login-input:focus { border-color: #1d5960; box-shadow: 0 0 0 4px rgba(29,89,96,.1); }
        .admin-login-button:focus-visible, .admin-login-brand a:focus-visible { outline: 3px solid #f0c66f; outline-offset: 4px; }
        @media (min-width: 640px) { .admin-login-brand { padding: 2.5rem 3rem; } .admin-login-content { padding-right: 3rem; padding-left: 3rem; } }
        @media (min-width: 1024px) { .admin-login-layout { grid-template-columns: 1.05fr .95fr; } .admin-login-brand { min-height: 100vh; padding: 3.5rem 4rem; } .admin-login-content { padding-right: 4rem; padding-left: 4rem; } }
        @media (prefers-reduced-motion: reduce) { .admin-login-page *, .admin-login-page *:before, .admin-login-page *:after { scroll-behavior: auto !important; transition-duration: .01ms !important; } }
    </style>
</head>
<body class="admin-login-page min-h-screen font-sans text-slate-900 antialiased">
    <main class="admin-login-layout">
        <section class="admin-login-brand">
            <div class="admin-login-orb" aria-hidden="true"></div>

            <a class="inline-flex w-fit items-center gap-3 rounded-full focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 focus-visible:ring-offset-4 focus-visible:ring-offset-[#102b35]" href="{{ url('/') }}" aria-label="BPR Karawang Jabar, kembali ke halaman utama">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/15 bg-white/10 text-sm font-black tracking-wide text-[#f0c66f]">BPR</span>
                <span class="leading-tight"><span class="block text-sm font-semibold tracking-wide">BPR Karawang Jabar</span><span class="mt-1 block text-xs text-white/60">Perseroda</span></span>
            </a>

            <div class="max-w-xl py-10 lg:py-0">
                <p class="mb-5 flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.24em] text-[#f0c66f]"><span class="h-px w-8 bg-[#f0c66f]"></span>Portal pengelolaan</p>
                <h1 class="max-w-lg text-4xl font-semibold leading-[1.12] tracking-tight sm:text-5xl lg:text-6xl">Melayani Karawang, <span class="font-serif italic font-normal text-[#f0c66f]">bertumbuh</span> bersama.</h1>
                <p class="mt-6 max-w-md text-sm leading-7 text-white/70 sm:text-base">Kelola informasi dan cerita perusahaan melalui satu ruang kerja yang aman.</p>
            </div>

            <div class="flex items-center justify-between border-t border-white/15 pt-5 text-xs text-white/50">
                <span>PT BPR Karawang Jabar (Perseroda)</span>
                <span class="hidden sm:inline">Mitra Keuangan Masyarakat Karawang</span>
            </div>
        </section>

        <section class="admin-login-content">
            <div class="admin-login-form">
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
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#263c41]" for="username">Username</label>
                        <input class="admin-login-input w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-400" id="username" name="username" type="text" autocomplete="username" autocapitalize="none" spellcheck="false" placeholder="Masukkan username" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#263c41]" for="password">Password</label>
                        <input class="admin-login-input w-full rounded-xl border border-slate-300 bg-white px-4 py-3.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-400" id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan password" required>
                    </div>
                    <button class="admin-login-button group mt-2 inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-slate-800 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-slate-900 focus:outline-none active:translate-y-px" type="submit">
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
