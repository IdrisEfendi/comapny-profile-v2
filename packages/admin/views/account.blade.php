@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800" role="status">{{ $success }}</div>
@endif

@if (! empty($error))
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800" role="alert">{{ $error }}</div>
@endif

<div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#9a742b]">Keamanan</p>
        <h2 class="mt-2 text-2xl font-semibold tracking-tight text-[#172b31]">Kelola akun administrator</h2>
        <p class="mt-2 text-sm text-slate-500">Tersimpan di tabel database <code>admin_users</code>, password disimpan sebagai hash.</p>
    </div>
    <a href="{{ url('admin/account/create') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#173f46] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#102b35] focus:outline-none focus-visible:ring-4 focus-visible:ring-[#173f46]/20">+ Tambah Akun</a>
</div>

<div class="mt-7 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-[#f8f8f4] text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3">Username</th>
                    <th class="px-5 py-3">Nama</th>
                    <th class="px-5 py-3">Login Terakhir</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($users as $user)
                    <tr class="transition hover:bg-[#fbfcfa]">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-slate-950">{{ $user['username'] }}</span>
                                @if (! empty($currentId) && $currentId === $user['id'])
                                    <span class="rounded-full bg-[#edf3ef] px-2 py-0.5 text-xs font-semibold text-[#28544c]">Anda</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ $user['name'] }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ ! empty($user['last_login_at']) ? $user['last_login_at'] : '-' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ url('admin/account/'.$user['id'].'/edit') }}" class="rounded-lg border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-[#28544c] hover:text-[#28544c]">Edit</a>
                                <form action="{{ url('admin/account/delete') }}" method="post" onsubmit="return confirm('Hapus akun ini?')">
                                    @php echo csrf_field(); @endphp
                                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                                    <button class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-50" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-5 py-10 text-center" colspan="4">
                            <p class="font-semibold text-slate-950">Belum ada akun</p>
                            <p class="mt-2 text-sm text-slate-600">Klik "Tambah Akun" untuk membuat akun admin pertama.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
