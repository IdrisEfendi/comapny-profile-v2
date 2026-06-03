<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - BPR Karawang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 via-blue-900 to-slate-950 text-slate-800">
    <main class="flex min-h-screen items-center justify-center px-4 py-12">
        <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-2xl">
            <div class="text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-800 text-sm font-bold text-white">BPR</div>
                <h1 class="mt-5 text-2xl font-bold text-slate-950">Login Admin</h1>
                <p class="mt-2 text-sm leading-6 text-slate-600">Masuk untuk mengelola pengaturan website company profile.</p>
            </div>

            @if (! empty($error))
                <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $error }}</div>
            @endif

            <form action="{{ url('admin/login') }}" method="post" class="mt-8 space-y-5">
                @php echo csrf_field(); @endphp
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="username">Username</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="username" name="username" type="text" autocomplete="username" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="password">Password</label>
                    <input class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-100" id="password" name="password" type="password" autocomplete="current-password" required>
                </div>
                <button class="inline-flex w-full items-center justify-center rounded-full bg-blue-800 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-950" type="submit">Masuk</button>
            </form>

            <p class="mt-6 text-center text-xs text-slate-500">Credential development diatur melalui file .env.</p>
        </div>
    </main>
</body>
</html>
