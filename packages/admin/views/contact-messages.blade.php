@layout('admin::layout')

@php
    $filters = isset($filters) ? $filters : ['q' => '', 'status' => 'all', 'page' => 1, 'perPage' => 10];
    $total = isset($total) ? $total : count($messages);
    $totalPages = isset($totalPages) ? $totalPages : 1;
    $currentPage = (int) $filters['page'];
    $baseParams = ['q' => $filters['q'], 'status' => $filters['status']];
    $currentBack = 'admin/contact-messages'.'?'.http_build_query(array_filter(array_merge($baseParams, ['page' => $currentPage]), function ($value) { return $value !== null && $value !== ''; }));
@endphp

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ $success }}</div>
@endif

@if (! empty($error))
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">{{ $error }}</div>
@endif

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Pesan Kontak</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">Pesan masuk dari website</h2>
            <p class="mt-2 text-sm text-slate-500">Menampilkan {{ count($messages) }} dari {{ $total }} pesan.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <span class="rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">Belum dibaca: {{ $unreadCount }}</span>
            <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-600">Total: {{ $total }}</span>
        </div>
    </div>

    <form action="{{ url('admin/contact-messages') }}" method="get" class="mt-8 grid gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 lg:grid-cols-12 lg:items-end">
        <div class="lg:col-span-6">
            <label class="block text-sm font-semibold text-slate-700">Cari pesan</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="q" type="search" value="{{ $filters['q'] }}" placeholder="Nama, kontak, subjek, atau isi pesan">
        </div>
        <div class="lg:col-span-3">
            <label class="block text-sm font-semibold text-slate-700">Status</label>
            <select class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="status">
                <option value="all" {{ $filters['status'] === 'all' ? 'selected' : '' }}>Semua</option>
                <option value="unread" {{ $filters['status'] === 'unread' ? 'selected' : '' }}>Belum dibaca</option>
                <option value="read" {{ $filters['status'] === 'read' ? 'selected' : '' }}>Sudah dibaca</option>
            </select>
        </div>
        <div class="flex gap-2 lg:col-span-3">
            <button class="inline-flex flex-1 items-center justify-center rounded-full bg-blue-800 px-5 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Terapkan</button>
            <a href="{{ url('admin/contact-messages') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:border-blue-700 hover:text-blue-800">Reset</a>
        </div>
    </form>

    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200">
        <div class="hidden grid-cols-12 gap-4 bg-slate-50 px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500 md:grid">
            <div class="col-span-3">Pengirim</div>
            <div class="col-span-3">Kontak</div>
            <div class="col-span-2">Subjek</div>
            <div class="col-span-2">Tanggal</div>
            <div class="col-span-2 text-right">Aksi</div>
        </div>

        <div class="divide-y divide-slate-200">
            @forelse ($messages as $message)
                <article class="grid gap-3 px-5 py-4 md:grid-cols-12 md:items-center md:gap-4 {{ ! $message->is_read ? 'bg-amber-50/60' : 'bg-white' }}">
                    <div class="md:col-span-3">
                        <div class="flex flex-wrap items-center gap-2">
                            <p class="font-semibold text-slate-950">{{ $message->name }}</p>
                            @if (! $message->is_read)
                                <span class="inline-flex rounded-full bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-800">Baru</span>
                            @else
                                <span class="inline-flex rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-500">Dibaca</span>
                            @endif
                        </div>
                    </div>
                    <div class="break-all text-sm text-slate-600 md:col-span-3">{{ $message->contact }}</div>
                    <div class="text-sm text-slate-600 md:col-span-2">{{ $message->subject }}</div>
                    <div class="text-sm text-slate-500 md:col-span-2">{{ $message->created_at }}</div>
                    <div class="flex flex-wrap gap-2 md:col-span-2 md:justify-end">
                        <a href="{{ url('admin/contact-messages/'.$message->id) }}" class="rounded-full bg-blue-800 px-4 py-2 text-xs font-bold text-white hover:bg-blue-950">Lihat</a>
                        <form action="{{ url('admin/contact-messages/status') }}" method="post">
                            @php echo csrf_field(); @endphp
                            <input type="hidden" name="id" value="{{ $message->id }}">
                            <input type="hidden" name="status" value="{{ $message->is_read ? 'unread' : 'read' }}">
                            <input type="hidden" name="back" value="{{ $currentBack }}">
                            <button class="rounded-full border border-slate-300 px-4 py-2 text-xs font-bold text-slate-700 hover:border-blue-700 hover:text-blue-800" type="submit">{{ $message->is_read ? 'Unread' : 'Read' }}</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="px-5 py-10 text-center text-sm text-slate-500">Belum ada pesan kontak sesuai filter.</div>
            @endforelse
        </div>
    </div>

    @if ($totalPages > 1)
        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-slate-500">Halaman {{ $currentPage }} dari {{ $totalPages }}</p>
            <div class="flex flex-wrap gap-2">
                @if ($currentPage > 1)
                    <a href="{{ admin_contact_messages_url(array_merge($baseParams, ['page' => $currentPage - 1])) }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-blue-700 hover:text-blue-800">Sebelumnya</a>
                @endif

                @for ($page = 1; $page <= $totalPages; $page++)
                    @if ($page === 1 || $page === $totalPages || abs($page - $currentPage) <= 2)
                        <a href="{{ admin_contact_messages_url(array_merge($baseParams, ['page' => $page])) }}" class="rounded-full px-4 py-2 text-sm font-semibold {{ $page === $currentPage ? 'bg-blue-800 text-white' : 'border border-slate-300 text-slate-700 hover:border-blue-700 hover:text-blue-800' }}">{{ $page }}</a>
                    @endif
                @endfor

                @if ($currentPage < $totalPages)
                    <a href="{{ admin_contact_messages_url(array_merge($baseParams, ['page' => $currentPage + 1])) }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-blue-700 hover:text-blue-800">Berikutnya</a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
