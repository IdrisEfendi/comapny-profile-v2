@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ $success }}</div>
@endif

@if (! empty($error))
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">{{ $error }}</div>
@endif

<div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Akun Admin</p>
        <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Kelola akun login admin</h2>
        <p class="mt-2 text-sm text-slate-500">Tersimpan di tabel database <code>admin_users</code>, password disimpan sebagai hash.</p>
    </div>
    <a href="{{ url('admin/account/create') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950">+ Tambah Akun</a>
</div>

<div class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/5">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3">Username</th>
                    <th class="px-5 py-3">Nama</th>
                    <th class="px-5 py-3">Login Terakhir</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-slate-950">{{ $user['username'] }}</span>
                                @if (! empty($currentId) && $currentId === $user['id'])
                                    <span class="rounded-full bg-blue-100 px-2 py-0.5 text-xs font-bold text-blue-700">Anda</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ $user['name'] }}</td>
                        <td class="px-5 py-4 text-slate-700">{{ ! empty($user['last_login_at']) ? $user['last_login_at'] : '-' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ url('admin/account/'.$user['id'].'/edit') }}" class="rounded-full border border-slate-300 px-4 py-2 text-xs font-semibold text-slate-700 hover:border-blue-700 hover:text-blue-800">Edit</a>
                                <form action="{{ url('admin/account/delete') }}" method="post" onsubmit="return confirm('Hapus akun ini?')">
                                    @php echo csrf_field(); @endphp
                                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                                    <button class="rounded-full border border-red-200 px-4 py-2 text-xs font-semibold text-red-700 hover:bg-red-50" type="submit">Hapus</button>
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
