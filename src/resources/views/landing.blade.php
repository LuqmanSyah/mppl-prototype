<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MPPL HR System</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-white antialiased">
  <main class="relative min-h-screen overflow-hidden">
    <div class="absolute inset-0">
      <img
        src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1800&q=80"
        alt=""
        class="h-full w-full object-cover opacity-40">
      <div class="absolute inset-0 bg-slate-950/70"></div>
    </div>

    <div class="relative mx-auto flex min-h-screen max-w-6xl items-center px-6 py-12">
      <section class="max-w-3xl">
        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-cyan-200">MPPL HR System</p>
        <h1 class="mt-4 text-4xl font-extrabold tracking-tight sm:text-6xl">Manajemen HR berbasis Filament</h1>
        <p class="mt-6 max-w-2xl text-base leading-8 text-slate-200 sm:text-lg">
          Kelola data karyawan, pengajuan cuti, penggajian, dan laporan dari satu panel admin yang sudah terintegrasi.
        </p>

        <div class="mt-8 flex flex-wrap gap-3">
          <a href="{{ url('/admin') }}"
            class="inline-flex items-center justify-center rounded-xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 transition hover:brightness-110">
            Masuk Panel Admin
          </a>
          <a href="{{ route('laporan.index') }}"
            class="inline-flex items-center justify-center rounded-xl border border-white/15 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/15">
            Lihat Laporan
          </a>
        </div>

        <div class="mt-10 grid gap-3 sm:grid-cols-3">
          <div class="rounded-lg border border-white/10 bg-white/10 p-4 backdrop-blur">
            <p class="text-2xl font-bold">{{ number_format($employeeCount) }}</p>
            <p class="mt-1 text-sm text-slate-300">Karyawan</p>
          </div>
          <div class="rounded-lg border border-white/10 bg-white/10 p-4 backdrop-blur">
            <p class="text-2xl font-bold">{{ number_format($pendingLeaveCount) }}</p>
            <p class="mt-1 text-sm text-slate-300">Cuti Menunggu</p>
          </div>
          <div class="rounded-lg border border-white/10 bg-white/10 p-4 backdrop-blur">
            <p class="text-2xl font-bold">{{ number_format($payrollCount) }}</p>
            <p class="mt-1 text-sm text-slate-300">Data Gaji</p>
          </div>
        </div>
      </section>
    </div>
  </main>
</body>

</html>
