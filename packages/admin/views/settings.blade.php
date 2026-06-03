@layout('admin::layout')

@section('content')
@if (! empty($success))
    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ $success }}</div>
@endif

<form action="{{ url('admin/settings') }}" method="post" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5">
    @php echo csrf_field(); @endphp
    <div class="grid gap-6 lg:grid-cols-2">
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="company_name">Nama Perusahaan</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="company_name" name="company_name" type="text" value="{{ $settings['company_name'] }}">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="tagline">Tagline</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="tagline" name="tagline" type="text" value="{{ $settings['tagline'] }}">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="phone">Telepon</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="phone" name="phone" type="text" value="{{ $settings['phone'] }}">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="email">Email</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="email" name="email" type="email" value="{{ $settings['email'] }}">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="office_hours">Jam Layanan</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="office_hours" name="office_hours" type="text" value="{{ $settings['office_hours'] }}">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700" for="whatsapp">WhatsApp</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="whatsapp" name="whatsapp" type="text" value="{{ $settings['whatsapp'] }}" placeholder="628xxxxxxxxxx">
        </div>
        <div class="lg:col-span-2">
            <label class="block text-sm font-semibold text-slate-700" for="address">Alamat</label>
            <textarea class="mt-2 min-h-24 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="address" name="address">{{ $settings['address'] }}</textarea>
        </div>
        <div class="lg:col-span-2">
            <label class="block text-sm font-semibold text-slate-700" for="google_maps_url">Google Maps URL</label>
            <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="google_maps_url" name="google_maps_url" type="url" value="{{ $settings['google_maps_url'] }}" placeholder="https://maps.google.com/...">
        </div>
    </div>

    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-slate-500">Data tersimpan di tabel database <code>site_settings</code>.</p>
        <button class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Simpan Pengaturan</button>
    </div>
</form>
@endsection
