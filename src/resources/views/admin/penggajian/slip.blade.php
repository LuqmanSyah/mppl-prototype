<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Slip Gaji Karyawan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <div
    class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(34,197,94,0.16),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.14),_transparent_24%),linear-gradient(135deg,_#020617_0%,_#0f172a_52%,_#111827_100%)]">
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
      <div
        class="mb-8 flex flex-col gap-4 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/30 backdrop-blur lg:flex-row lg:items-end lg:justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.3em] text-emerald-200">Slip Gaji</p>
          <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Rincian Gaji Karyawan</h1>
          <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
            Tampilan ini menyajikan komponen kalkulasi sederhana: gaji pokok, tunjangan, dan potongan ketidakhadiran.
          </p>
        </div>

        <div class="flex flex-wrap gap-3">
          <a href="{{ route('penggajian.index') }}"
            class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Kembali
            ke Daftar</a>
          <button type="button"
            class="inline-flex items-center justify-center rounded-2xl bg-emerald-400 px-5 py-3 text-sm font-bold text-slate-950 transition hover:brightness-110">Cetak
            Slip</button>
        </div>
      </div>

      <div
        class="overflow-hidden rounded-3xl border border-white/10 bg-slate-900/75 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl">
        <div class="border-b border-white/10 px-6 py-5">
          <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
              <h2 class="text-xl font-semibold text-white">Detail Pegawai</h2>
              <p class="mt-1 text-sm text-slate-400">Ayu Permata Sari · HR Officer</p>
            </div>
            <div class="rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-right">
              <p class="text-[10px] font-semibold uppercase tracking-[0.24em] text-emerald-100">Periode</p>
              <p class="text-sm font-medium text-white">Mei 2026</p>
            </div>
          </div>
        </div>

        <div class="grid gap-6 px-6 py-6 lg:grid-cols-[0.95fr_1.05fr]">
          <div class="space-y-4 rounded-3xl border border-white/10 bg-slate-950/55 p-5">
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
              <span class="text-sm text-slate-400">NIK</span>
              <span class="font-semibold text-white">EMP-0001</span>
            </div>
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
              <span class="text-sm text-slate-400">Jabatan</span>
              <span class="font-semibold text-white">HR Officer</span>
            </div>
            <div class="flex items-center justify-between border-b border-white/10 pb-3">
              <span class="text-sm text-slate-400">Departemen</span>
              <span class="font-semibold text-white">Human Resource</span>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-sm text-slate-400">Status Akses</span>
              <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-200">Dapat
                dilihat Admin HR / Karyawan</span>
            </div>
          </div>

          <div class="space-y-4 rounded-3xl border border-white/10 bg-slate-950/55 p-5">
            <div class="grid gap-3 sm:grid-cols-2">
              <div class="rounded-2xl bg-white/5 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">Gaji Pokok</p>
                <p class="mt-2 text-2xl font-bold text-white">Rp 6.500.000</p>
              </div>
              <div class="rounded-2xl bg-white/5 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">Tunjangan</p>
                <p class="mt-2 text-2xl font-bold text-white">Rp 1.250.000</p>
              </div>
              <div class="rounded-2xl bg-white/5 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-400">Potongan Ketidakhadiran</p>
                <p class="mt-2 text-2xl font-bold text-white">Rp 150.000</p>
              </div>
              <div class="rounded-2xl border border-emerald-400/20 bg-emerald-400/10 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-emerald-100">Gaji Bersih</p>
                <p class="mt-2 text-2xl font-bold text-emerald-100">Rp 7.600.000</p>
              </div>
            </div>

            <div class="rounded-2xl border border-white/10 bg-slate-900/70 p-4 text-sm leading-6 text-slate-300">
              Rumus sederhana: gaji pokok + tunjangan - potongan kehadiran. Halaman ini dapat dipakai untuk tinjauan
              Admin HR atau self-service karyawan.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
