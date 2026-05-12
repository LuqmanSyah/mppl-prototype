<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kalkulasi & Daftar Penggajian</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <div
    class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(168,85,247,0.18),_transparent_26%),radial-gradient(circle_at_bottom_right,_rgba(14,165,233,0.14),_transparent_24%),linear-gradient(135deg,_#020617_0%,_#0f172a_52%,_#111827_100%)]">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
      <div
        class="mb-8 flex flex-col gap-4 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/30 backdrop-blur lg:flex-row lg:items-end lg:justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.3em] text-violet-200">Modul Penggajian</p>
          <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Kalkulasi & Daftar Penggajian
          </h1>
          <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
            Halaman ini menampilkan daftar perhitungan gaji karyawan dengan komponen gaji pokok, tunjangan, dan potongan
            kehadiran.
          </p>
        </div>

        <div class="flex flex-wrap gap-3">
          <a href="{{ route('penggajian.slip') }}"
            class="inline-flex items-center justify-center rounded-2xl bg-violet-400 px-5 py-3 text-sm font-bold text-slate-950 transition hover:brightness-110">Lihat
            Slip Gaji</a>
          <button type="button"
            class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Hitung
            Ulang</button>
        </div>
      </div>

      <div class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
        <div
          class="overflow-hidden rounded-3xl border border-white/10 bg-slate-900/70 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl">
          <div class="border-b border-white/10 px-6 py-4">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
              <div>
                <h2 class="text-lg font-semibold text-white">Daftar Kalkulasi Gaji</h2>
                <p class="mt-1 text-sm text-slate-400">Rincian sederhana untuk kebutuhan preview Admin HR.</p>
              </div>
              <div class="grid gap-3 sm:grid-cols-3">
                <select
                  class="rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 outline-none focus:border-violet-400 focus:ring-4 focus:ring-violet-400/10">
                  <option>Semua Periode</option>
                  <option>Januari 2026</option>
                  <option>Februari 2026</option>
                  <option>Maret 2026</option>
                </select>
                <select
                  class="rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 outline-none focus:border-violet-400 focus:ring-4 focus:ring-violet-400/10">
                  <option>Semua Departemen</option>
                  <option>HR</option>
                  <option>Finance</option>
                  <option>Operasional</option>
                </select>
                <input type="text" placeholder="Cari karyawan..."
                  class="rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 placeholder:text-slate-500 outline-none focus:border-violet-400 focus:ring-4 focus:ring-violet-400/10">
              </div>
            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10">
              <thead class="bg-white/5 text-left text-xs uppercase tracking-[0.22em] text-slate-400">
                <tr>
                  <th class="px-6 py-4 font-semibold">Karyawan</th>
                  <th class="px-6 py-4 font-semibold">Gaji Pokok</th>
                  <th class="px-6 py-4 font-semibold">Tunjangan</th>
                  <th class="px-6 py-4 font-semibold">Potongan Kehadiran</th>
                  <th class="px-6 py-4 font-semibold">Total</th>
                  <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-white/10 text-sm">
                <tr class="bg-slate-950/40">
                  <td class="px-6 py-4">
                    <p class="font-medium text-white">Ayu Permata Sari</p>
                    <p class="text-xs text-slate-400">HR Officer · HR</p>
                  </td>
                  <td class="px-6 py-4 text-slate-200">Rp 6.500.000</td>
                  <td class="px-6 py-4 text-slate-200">Rp 1.250.000</td>
                  <td class="px-6 py-4 text-slate-200">Rp 150.000</td>
                  <td class="px-6 py-4 font-semibold text-violet-200">Rp 7.600.000</td>
                  <td class="px-6 py-4 text-right"><a href="{{ route('penggajian.slip') }}"
                      class="rounded-xl border border-violet-400/20 bg-violet-400/10 px-3 py-2 text-xs font-semibold text-violet-200 hover:bg-violet-400/20">Detail</a>
                  </td>
                </tr>
                <tr class="bg-slate-900/60">
                  <td class="px-6 py-4">
                    <p class="font-medium text-white">Bima Pratama</p>
                    <p class="text-xs text-slate-400">Supervisor · Operasional</p>
                  </td>
                  <td class="px-6 py-4 text-slate-200">Rp 8.000.000</td>
                  <td class="px-6 py-4 text-slate-200">Rp 1.500.000</td>
                  <td class="px-6 py-4 text-slate-200">Rp 250.000</td>
                  <td class="px-6 py-4 font-semibold text-violet-200">Rp 9.250.000</td>
                  <td class="px-6 py-4 text-right"><a href="{{ route('penggajian.slip') }}"
                      class="rounded-xl border border-violet-400/20 bg-violet-400/10 px-3 py-2 text-xs font-semibold text-violet-200 hover:bg-violet-400/20">Detail</a>
                  </td>
                </tr>
                <tr class="bg-slate-950/40">
                  <td class="px-6 py-4">
                    <p class="font-medium text-white">Citra Lestari</p>
                    <p class="text-xs text-slate-400">Finance Staff · Finance</p>
                  </td>
                  <td class="px-6 py-4 text-slate-200">Rp 5.750.000</td>
                  <td class="px-6 py-4 text-slate-200">Rp 1.100.000</td>
                  <td class="px-6 py-4 text-slate-200">Rp 100.000</td>
                  <td class="px-6 py-4 font-semibold text-violet-200">Rp 6.750.000</td>
                  <td class="px-6 py-4 text-right"><a href="{{ route('penggajian.slip') }}"
                      class="rounded-xl border border-violet-400/20 bg-violet-400/10 px-3 py-2 text-xs font-semibold text-violet-200 hover:bg-violet-400/20">Detail</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <aside class="space-y-6">
          <div
            class="rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/30 backdrop-blur-xl">
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-violet-200">Ringkasan Kalkulasi</p>
            <div class="mt-4 space-y-4 text-sm text-slate-300">
              <div class="flex items-center justify-between rounded-2xl bg-slate-950/50 px-4 py-3">
                <span>Gaji Pokok Total</span>
                <span class="font-semibold text-white">Rp 20.250.000</span>
              </div>
              <div class="flex items-center justify-between rounded-2xl bg-slate-950/50 px-4 py-3">
                <span>Tunjangan Total</span>
                <span class="font-semibold text-white">Rp 3.850.000</span>
              </div>
              <div class="flex items-center justify-between rounded-2xl bg-slate-950/50 px-4 py-3">
                <span>Potongan Total</span>
                <span class="font-semibold text-white">Rp 500.000</span>
              </div>
              <div
                class="flex items-center justify-between rounded-2xl border border-violet-400/20 bg-violet-400/10 px-4 py-3">
                <span class="font-semibold text-white">Total Bersih</span>
                <span class="font-bold text-violet-100">Rp 23.600.000</span>
              </div>
            </div>
          </div>

          <div
            class="rounded-3xl border border-white/10 bg-slate-900/70 p-6 text-sm leading-6 text-slate-300 shadow-2xl shadow-slate-950/30 backdrop-blur-xl">
            Halaman ini dirancang sebagai preview Admin HR untuk kalkulasi gaji sederhana: gaji pokok ditambah tunjangan
            lalu dikurangi potongan kehadiran.
          </div>
        </aside>
      </div>
    </div>
  </div>
</body>

</html>
