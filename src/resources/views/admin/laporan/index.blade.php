<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pusat Unduh / Laporan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <div
    class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.18),_transparent_26%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.14),_transparent_24%),linear-gradient(135deg,_#020617_0%,_#0f172a_52%,_#111827_100%)]">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
      <div class="mb-8 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/30 backdrop-blur">
        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-200">Modul Laporan</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Pusat Unduh / Laporan</h1>
        <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-300">
          Panel ini menyediakan akses ekspor data untuk Admin HR dan Manajer dalam format PDF atau Excel.
        </p>
      </div>

      <div class="grid gap-6 lg:grid-cols-3">
        <section
          class="rounded-3xl border border-white/10 bg-slate-900/70 p-6 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl">
          <div class="flex items-start justify-between gap-4">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-200">Laporan Data</p>
              <h2 class="mt-2 text-xl font-bold text-white">Daftar Karyawan</h2>
            </div>
            <span class="rounded-full bg-cyan-400/15 px-3 py-1 text-xs font-semibold text-cyan-200">Admin HR</span>
          </div>
          <p class="mt-3 text-sm leading-6 text-slate-300">Ekspor daftar karyawan untuk rekap internal, arsip, atau
            kebutuhan cetak.</p>
          <div class="mt-6 grid gap-3 sm:grid-cols-2">
            <a href="{{ route('laporan.preview', ['document' => 'karyawan', 'format' => 'pdf']) }}"
              class="rounded-2xl bg-violet-400 px-4 py-3 text-center text-sm font-bold text-slate-950 transition hover:brightness-110">PDF</a>
            <a href="{{ route('laporan.preview', ['document' => 'karyawan', 'format' => 'excel']) }}"
              class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-white/10">Excel</a>
          </div>
        </section>

        <section
          class="rounded-3xl border border-white/10 bg-slate-900/70 p-6 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl">
          <div class="flex items-start justify-between gap-4">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.24em] text-emerald-200">Laporan Approval</p>
              <h2 class="mt-2 text-xl font-bold text-white">Riwayat Cuti</h2>
            </div>
            <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-200">HR /
              Manajer</span>
          </div>
          <p class="mt-3 text-sm leading-6 text-slate-300">Unduh histori cuti untuk penelusuran persetujuan, penolakan,
            dan jejak proses.</p>
          <div class="mt-6 grid gap-3 sm:grid-cols-2">
            <a href="{{ route('laporan.preview', ['document' => 'cuti', 'format' => 'pdf']) }}"
              class="rounded-2xl bg-violet-400 px-4 py-3 text-center text-sm font-bold text-slate-950 transition hover:brightness-110">PDF</a>
            <a href="{{ route('laporan.preview', ['document' => 'cuti', 'format' => 'excel']) }}"
              class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-white/10">Excel</a>
          </div>
        </section>

        <section
          class="rounded-3xl border border-white/10 bg-slate-900/70 p-6 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl">
          <div class="flex items-start justify-between gap-4">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.24em] text-amber-200">Laporan Gaji</p>
              <h2 class="mt-2 text-xl font-bold text-white">Slip Gaji</h2>
            </div>
            <span class="rounded-full bg-amber-400/15 px-3 py-1 text-xs font-semibold text-amber-200">HR /
              Karyawan</span>
          </div>
          <p class="mt-3 text-sm leading-6 text-slate-300">Ekspor slip gaji untuk tinjauan manajemen atau distribusi ke
            karyawan.</p>
          <div class="mt-6 grid gap-3 sm:grid-cols-2">
            <a href="{{ route('laporan.preview', ['document' => 'gaji', 'format' => 'pdf']) }}"
              class="rounded-2xl bg-violet-400 px-4 py-3 text-center text-sm font-bold text-slate-950 transition hover:brightness-110">PDF</a>
            <a href="{{ route('laporan.preview', ['document' => 'gaji', 'format' => 'excel']) }}"
              class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-white/10">Excel</a>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

</html>
