@layout('admin::layout')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
@php
    $n = $item ? $item : ['id' => null, 'slug' => '', 'title' => '', 'category' => '', 'summary' => '', 'content' => '', 'image_path' => '', 'pdf_path' => '', 'is_published' => true, 'published_at' => null];
    $isEdit = $item ? true : false;
@endphp

@if (! empty($error))
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">{{ $error }}</div>
@endif

<div class="mx-auto max-w-3xl">
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5 sm:p-8">
        <p class="text-sm font-bold uppercase tracking-widest text-blue-700">{{ $isEdit ? 'Edit Berita' : 'Tambah Berita' }}</p>
        <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-950">{{ $isEdit ? 'Perbarui berita' : 'Berita baru' }}</h2>

        <form action="{{ url('admin/news') }}" method="post" enctype="multipart/form-data" class="mt-8 space-y-5">
            @php echo csrf_field(); @endphp

            @if ($isEdit)
                <input type="hidden" name="original_id" value="{{ $n['id'] }}">
            @endif

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700">Judul Berita</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="title" type="text" value="{{ $n['title'] }}" placeholder="Judul berita" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Slug</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="slug" type="text" value="{{ $n['slug'] }}" placeholder="judul-berita">
                    <p class="mt-2 text-xs text-slate-500">Kosongkan untuk dibuat otomatis dari judul.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700">Kategori</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="category" type="text" value="{{ $n['category'] }}" placeholder="Pengumuman / Informasi">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Ringkasan</label>
                <textarea class="mt-2 min-h-28 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" name="summary" placeholder="Ringkasan berita">{{ $n['summary'] }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700">Isi Berita</label>
                <div class="mt-3 overflow-hidden rounded-2xl border border-slate-300 bg-white">
                    <div id="content-editor" class="min-h-64 text-sm text-slate-800"></div>
                </div>
                <textarea class="hidden" name="content" id="content-input">{{ $n['content'] }}</textarea>
                <p class="mt-2 text-xs text-slate-500">Gunakan toolbar untuk memformat teks.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Gambar Berita</label>
                    @if (! empty($n['image_path']))
                        <img src="{{ asset($n['image_path']) }}" alt="Gambar {{ $n['title'] }}" class="mt-3 h-32 w-full rounded-2xl object-cover">
                    @endif
                    <input class="mt-3 block w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" name="image" type="file" accept="image/jpeg,image/png,image/webp,image/gif">
                    <p class="mt-2 text-xs text-slate-500">JPG, PNG, WEBP, atau GIF. Maksimal 2MB.</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Lampiran PDF</label>
                    @if (! empty($n['pdf_path']))
                        <a href="{{ asset($n['pdf_path']) }}" target="_blank" rel="noopener" class="mt-3 inline-flex rounded-full bg-red-50 px-4 py-2 text-sm font-semibold text-red-700">Lihat PDF saat ini</a>
                    @endif
                    <input class="mt-3 block w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" name="pdf" type="file" accept="application/pdf">
                    <p class="mt-2 text-xs text-slate-500">PDF maksimal 2MB.</p>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
            <script>
                (function () {
                    var input = document.getElementById('content-input');
                    var editor = document.getElementById('content-editor');

                    if (! input || ! editor || typeof Quill === 'undefined') {
                        return;
                    }

                    var quill = new Quill(editor, {
                        theme: 'snow',
                        placeholder: 'Tulis isi berita di sini...',
                        modules: {
                            toolbar: {
                                container: [
                                    [{ header: [2, 3, false] }],
                                    ['bold', 'italic', 'underline'],
                                    [{ list: 'ordered' }, { list: 'bullet' }],
                                    ['blockquote', 'link'],
                                    ['clean']
                                ]
                            }
                        }
                    });

                    // Konten lama tersimpan sebagai teks biasa; ubah ke HTML agar tampil rapi.
                    function toHtml(text) {
                        var trimmed = (text || '').trim();

                        if (trimmed === '') {
                            return '';
                        }

                        if (/<[a-z][\s\S]*>/i.test(trimmed)) {
                            return text;
                        }

                        return trimmed.split(/\n{2,}/).map(function (paragraph) {
                            var safe = paragraph.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

                            return '<p>' + safe.replace(/\n/g, '<br>') + '</p>';
                        }).join('');
                    }

                    quill.root.innerHTML = toHtml(input.value);

                    var form = editor.closest('form');

                    if (form) {
                        form.addEventListener('submit', function () {
                            var html = quill.root.innerHTML;

                            input.value = (html === '<p><br></p>') ? '' : html;
                        });
                    }
                })();
            </script>

            <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                <input name="is_published" type="checkbox" value="1" {{ ! empty($n['is_published']) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-blue-800 focus:ring-blue-700">
                Tampilkan di website
            </label>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button class="inline-flex items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Simpan Berita</button>
                <a href="{{ url('admin/news') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 hover:border-slate-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
