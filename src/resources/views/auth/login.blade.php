<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Login Multi-Level</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0f172a] text-slate-100 antialiased font-sans">
  <div
    class="relative isolate min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.24),_transparent_38%),radial-gradient(circle_at_bottom_right,_rgba(251,191,36,0.16),_transparent_32%),linear-gradient(135deg,_#0f172a_0%,_#111827_45%,_#0b1120_100%)]">
    <div
      class="absolute inset-0 opacity-30 [background-image:linear-gradient(rgba(255,255,255,0.05)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.05)_1px,transparent_1px)] [background-size:72px_72px]">
    </div>

    <div class="relative mx-auto flex min-h-screen w-full max-w-7xl items-center px-4 py-10 sm:px-6 lg:px-8">
      <div class="grid w-full gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
        <section class="order-2 lg:order-1">
          <div
            class="inline-flex items-center gap-2 rounded-full border border-cyan-400/20 bg-white/6 px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-cyan-200 backdrop-blur">
            Modul Autentikasi
          </div>

          <h1 class="mt-6 max-w-xl text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            Masuk ke sistem sesuai level akses.
          </h1>

          <p class="mt-5 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg">
            Halaman ini disiapkan untuk simulasi login multi-level bagi Admin HR, Manajer, dan Karyawan.
            Gunakan email atau username, kata sandi, lalu pilih role bila diperlukan untuk prototype.
          </p>

          <div class="mt-8 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-white/10 bg-white/6 p-4 shadow-2xl shadow-slate-950/20 backdrop-blur">
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-200">Admin HR</p>
              <p class="mt-2 text-sm leading-6 text-slate-300">Akses pengelolaan data, kebijakan, dan otorisasi.</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/6 p-4 shadow-2xl shadow-slate-950/20 backdrop-blur">
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-200">Manajer</p>
              <p class="mt-2 text-sm leading-6 text-slate-300">Pantau tim, persetujuan, dan ringkasan operasional.</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/6 p-4 shadow-2xl shadow-slate-950/20 backdrop-blur">
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-200">Karyawan</p>
              <p class="mt-2 text-sm leading-6 text-slate-300">Masuk ke portal pribadi untuk aktivitas harian.</p>
            </div>
          </div>
        </section>

        <section class="order-1 lg:order-2">
          <div
            class="rounded-3xl border border-white/10 bg-white/8 p-6 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl sm:p-8">
            <div class="mb-8 flex items-start justify-between gap-4">
              <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-cyan-200">Login Prototype</p>
                <h2 class="mt-2 text-2xl font-bold text-white">Silakan masuk</h2>
                <p class="mt-2 text-sm leading-6 text-slate-300">
                  Form ini fokus pada skenario demo dan belum memproses autentikasi backend.
                </p>
              </div>
              <div class="rounded-2xl border border-cyan-400/20 bg-cyan-400/10 px-3 py-2 text-right">
                <p class="text-[10px] font-semibold uppercase tracking-[0.24em] text-cyan-100">Preview</p>
                <p class="text-sm font-medium text-white">v1.0</p>
              </div>
            </div>

            <form action="#" method="post" class="space-y-5">
              @csrf

              <div>
                <label for="identity" class="mb-2 block text-sm font-medium text-slate-200">Email atau Username</label>
                <input id="identity" name="identity" type="text" placeholder="contoh: hr@example.com"
                  class="w-full rounded-2xl border border-white/10 bg-slate-950/45 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/15">
              </div>

              <div>
                <label for="password" class="mb-2 block text-sm font-medium text-slate-200">Kata Sandi</label>
                <input id="password" name="password" type="password" placeholder="Masukkan kata sandi"
                  class="w-full rounded-2xl border border-white/10 bg-slate-950/45 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/15">
              </div>

              <div>
                <label for="role" class="mb-2 block text-sm font-medium text-slate-200">Role Login</label>
                <select id="role" name="role"
                  class="w-full rounded-2xl border border-white/10 bg-slate-950/45 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/15">
                  <option value="" selected>Otomatis / pilih role</option>
                  <option value="admin-hr">Admin HR</option>
                  <option value="manager">Manajer</option>
                  <option value="employee">Karyawan</option>
                </select>
                <p class="mt-2 text-xs leading-5 text-slate-400">
                  Opsional, dipakai untuk memperjelas skenario simulasi prototype.
                </p>
              </div>

              <div class="flex items-center justify-between gap-4 pt-1">
                <label class="flex items-center gap-3 text-sm text-slate-300">
                  <input type="checkbox" name="remember"
                    class="h-4 w-4 rounded border-white/20 bg-slate-950/45 text-cyan-400 focus:ring-cyan-400/30">
                  Ingat saya
                </label>

                <a href="#" class="text-sm font-medium text-cyan-200 transition hover:text-cyan-100">Lupa kata
                  sandi?</a>
              </div>

              <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-r from-cyan-400 to-emerald-400 px-4 py-3.5 text-sm font-bold text-slate-950 shadow-lg shadow-cyan-500/20 transition hover:brightness-110 focus:outline-none focus:ring-4 focus:ring-cyan-300/30">
                Login
              </button>
            </form>

            <div
              class="mt-8 rounded-2xl border border-amber-400/15 bg-amber-400/10 p-4 text-sm leading-6 text-amber-100">
              Catatan: halaman ini adalah tampilan frontend untuk kebutuhan prototype dan belum terhubung ke proses
              autentikasi server.
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

</html>
