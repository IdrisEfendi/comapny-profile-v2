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
        <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Daftar Berita</p>
        <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Kelola berita dan pengumuman</h2>
        <p class="mt-2 text-sm text-slate-500">Tersimpan di tabel database <code>news</code></p>
    </div>
    <a href="{{ url('admin/news/create') }}" class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950">+ Tambah Berita</a>
</div>

<div class="mt-8 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/5">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3">Judul</th>
                    <th class="px-5 py-3">Kategori</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Tanggal Terbit</th>
                    <th class="px-5 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($news as $item)
                    <tr>
                        <td class="px-5 py-4">
                            <p class="font-semibold text-slate-950">{{ $item['title'] }}</p>
                            <p class="text-xs text-slate-500">{{ $item['slug'] }}</p>
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ $item['category'] !== '' ? $item['category'] : '-' }}</td>
                        <td class="px-5 py-4">
                            @if (! empty($item['is_published']))
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Tampil</span>
                            @else
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">Draft</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-700">{{ ! empty($item['published_at']) ? $item['published_at'] : '-' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ url('admin/news/'.$item['id'].'/edit') }}" class="rounded-full border border-slate-300 px-4 py-2 text-xs font-semibold text-slate-700 hover:border-blue-700 hover:text-blue-800">Edit</a>
                                <form action="{{ url('admin/news/delete') }}" method="post" onsubmit="return confirm('Hapus berita ini?')">
                                    @php echo csrf_field(); @endphp
                                    <input type="hidden" name="slug" value="{{ $item['slug'] }}">
                                    <input type="hidden" name="page" value="{{ $filters['page'] }}">
                                    <button class="rounded-full border border-red-200 px-4 py-2 text-xs font-semibold text-red-700 hover:bg-red-50" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-5 py-10 text-center" colspan="5">
                            <p class="font-semibold text-slate-950">Belum ada berita</p>
                            <p class="mt-2 text-sm text-slate-600">Klik "Tambah Berita" untuk menambahkan berita atau pengumuman pertama.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (isset($totalPages) && $totalPages > 1)
        <div class="flex flex-col gap-4 border-t border-slate-200 bg-white p-5 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-slate-500">Halaman {{ $filters['page'] }} dari {{ $totalPages }} ({{ $total }} berita)</p>
            <div class="flex gap-3">
                @if ($filters['page'] > 1)
                    <a class="inline-flex items-center justify-center rounded-full border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-700 hover:border-blue-700 hover:text-blue-800" href="{{ url('admin/news?page='.($filters['page'] - 1)) }}">Sebelumnya</a>
                @endif
                @if ($filters['page'] < $totalPages)
                    <a class="inline-flex items-center justify-center rounded-full bg-blue-800 px-5 py-2 text-sm font-bold text-white shadow-lg hover:bg-blue-950" href="{{ url('admin/news?page='.($filters['page'] + 1)) }}">Berikutnya</a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
