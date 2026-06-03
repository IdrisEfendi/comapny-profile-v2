@layout('admin::layout')

@section('content')
@if (! $message)
    <div class="rounded-3xl border border-red-200 bg-red-50 p-6 text-red-700">Pesan tidak ditemukan.</div>
@else
    <div class="max-w-4xl rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-widest text-blue-700">Detail Pesan</p>
                <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">{{ $message->subject }}</h2>
                <p class="mt-2 text-sm text-slate-500">Dikirim pada {{ $message->created_at }}</p>
            </div>
            <a href="{{ url('admin/contact-messages') }}" class="inline-flex rounded-full border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-700 hover:border-blue-700 hover:text-blue-800">Kembali</a>
        </div>

        <div class="mt-8 grid gap-5 sm:grid-cols-2">
            <div class="rounded-2xl bg-slate-50 p-5">
                <p class="text-sm font-semibold text-slate-500">Nama</p>
                <p class="mt-1 font-bold text-slate-950">{{ $message->name }}</p>
            </div>
            <div class="rounded-2xl bg-slate-50 p-5">
                <p class="text-sm font-semibold text-slate-500">Email / Telepon</p>
                <p class="mt-1 break-all font-bold text-slate-950">{{ $message->contact }}</p>
            </div>
            <div class="rounded-2xl bg-slate-50 p-5">
                <p class="text-sm font-semibold text-slate-500">IP Address</p>
                <p class="mt-1 font-bold text-slate-950">{{ $message->ip_address }}</p>
            </div>
            <div class="rounded-2xl bg-slate-50 p-5">
                <p class="text-sm font-semibold text-slate-500">User Agent</p>
                <p class="mt-1 break-all text-sm text-slate-700">{{ $message->user_agent }}</p>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-slate-200 p-5">
            <p class="text-sm font-semibold text-slate-500">Pesan</p>
            <p class="mt-3 whitespace-pre-line leading-7 text-slate-700">{{ $message->message }}</p>
        </div>

        <form action="{{ url('admin/contact-messages/delete') }}" method="post" class="mt-6">
            <input type="hidden" name="id" value="{{ $message->id }}">
            <button class="inline-flex rounded-full border border-red-200 px-5 py-2 text-sm font-semibold text-red-700 hover:bg-red-50" type="submit">Hapus Pesan</button>
        </form>
    </div>
@endif
@endsection
