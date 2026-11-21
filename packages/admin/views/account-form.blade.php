@layout('admin::layout')

@section('content')
@php
    $u = $user ? $user : ['id' => null, 'username' => '', 'name' => '', 'is_active' => true, 'last_login_at' => null];
    $isEdit = ! empty($u['id']);
@endphp

@if (! empty($error))
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800" role="alert">{{ $error }}</div>
@endif

<div class="mx-auto max-w-xl">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">{{ $isEdit ? 'Edit Akun' : 'Tambah Akun' }}</p>
        <h2 class="mt-2 text-2xl font-semibold tracking-tight text-[#172b31]">{{ $isEdit ? 'Perbarui akun admin' : 'Akun admin baru' }}</h2>

        <form action="{{ url('admin/account') }}" method="post" class="mt-8 space-y-5">
            @php echo csrf_field(); @endphp

            @if ($isEdit)
                <input type="hidden" name="original_id" value="{{ $u['id'] }}">
            @endif

            <div>
                <label class="block text-sm font-semibold text-slate-700" for="username">Username</label>
                <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="username" name="username" type="text" value="{{ $u['username'] }}" autocomplete="off" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700" for="name">Nama Tampilan</label>
                <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="name" name="name" type="text" value="{{ $u['name'] }}" placeholder="Administrator">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700" for="password">Password {{ $isEdit ? 'Baru' : '' }}</label>
                <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="password" name="password" type="password" minlength="8" placeholder="{{ $isEdit ? 'Kosongkan jika tidak diganti' : 'Minimal 8 karakter' }}" autocomplete="new-password" {{ $isEdit ? '' : 'required' }}>
                <p class="mt-2 text-xs text-slate-500">
                    @if ($isEdit)
                        Biarkan kosong jika password tidak ingin diubah. Minimal 8 karakter bila diisi.
                    @else
                        Password minimal 8 karakter.
                    @endif
                </p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700" for="confirm_password">Konfirmasi Password</label>
                <input class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-[#28544c] focus:ring-4 focus:ring-[#173f46]/10" id="confirm_password" name="confirm_password" type="password" minlength="8" placeholder="Ulangi password" autocomplete="new-password">
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#173f46] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#102b35] focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/20" type="submit">Simpan Akun</button>
                <a href="{{ url('admin/account') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-[#28544c] hover:text-[#28544c]">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
