@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ $success }}</div>
@endif

@if (! empty($error))
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">{{ $error }}</div>
@endif

<form action="{{ url('admin/account') }}" method="post" class="max-w-3xl rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
    <div>
        <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Keamanan Admin</p>
        <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Kelola akun login</h2>
        <p class="mt-3 text-sm leading-6 text-slate-600">Akun admin sekarang tersimpan di tabel database <code>admin_users</code> dan password disimpan menggunakan hash.</p>
    </div>

    <div class="mt-8 grid gap-6 sm:grid-cols-2">
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="username">Username</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="username" name="username" type="text" value="{{ $user ? $user->username : '' }}" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="name">Nama Tampilan</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="name" name="name" type="text" value="{{ $user ? $user->name : 'Administrator' }}">
        </div>
        <div class="sm:col-span-2">
            <label class="block text-sm font-semibold text-slate-700" for="current_password">Password Saat Ini</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="current_password" name="current_password" type="password" required>
            <p class="mt-2 text-xs text-slate-500">Wajib diisi untuk menyimpan perubahan akun.</p>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="new_password">Password Baru</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="new_password" name="new_password" type="password" minlength="8" placeholder="Kosongkan jika tidak diganti">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="confirm_password">Konfirmasi Password Baru</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="confirm_password" name="confirm_password" type="password" minlength="8" placeholder="Ulangi password baru">
        </div>
    </div>

    <div class="mt-8 flex justify-end">
        <button class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Simpan Akun</button>
    </div>
</form>
@endsection
