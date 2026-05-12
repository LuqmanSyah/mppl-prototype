<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Histori Cuti Karyawan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <div
    class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.18),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(34,197,94,0.14),_transparent_24%),linear-gradient(135deg,_#020617_0%,_#0f172a_52%,_#111827_100%)]">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
      <div
        class="mb-8 flex flex-col gap-4 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/30 backdrop-blur lg:flex-row lg:items-end lg:justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-200">Modul Manajemen Cuti</p>
          <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Histori & Status Cuti</h1>
          <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
            Halaman ini menampilkan riwayat pengajuan cuti milik karyawan beserta statusnya: menunggu, disetujui, atau
            ditolak.
          </p>
        </div>

        <div class="flex flex-wrap gap-3">
          <a href="{{ route('cuti.form') }}"
            class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 transition hover:brightness-110">Ajukan
            Cuti Baru</a>
          <a href="{{ route('cuti.approval') }}"
            class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Lihat
            Approval</a>
        </div>
      </div>

      <div
        class="overflow-hidden rounded-3xl border border-white/10 bg-slate-900/70 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl">
        <div class="border-b border-white/10 px-6 py-4">
          <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
              <h2 class="text-lg font-semibold text-white">Riwayat Pengajuan</h2>
              <p class="mt-1 text-sm text-slate-400">Akses khusus karyawan untuk memantau status cuti yang diajukan.</p>
            </div>
            <div class="grid gap-3 sm:grid-cols-3">
              <select
                class="rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
                <option>Semua Status</option>
                <option>Menunggu</option>
                <option>Disetujui</option>
                <option>Ditolak</option>
              </select>
              <select
                class="rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
                <option>Semua Jenis</option>
                <option>Cuti Tahunan</option>
                <option>Cuti Sakit</option>
                <option>Cuti Khusus</option>
              </select>
              <input type="month"
                class="rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
            </div>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-white/10">
            <thead class="bg-white/5 text-left text-xs uppercase tracking-[0.22em] text-slate-400">
              <tr>
                <th class="px-6 py-4 font-semibold">Periode</th>
                <th class="px-6 py-4 font-semibold">Jenis Cuti</th>
                <th class="px-6 py-4 font-semibold">Alasan</th>
                <th class="px-6 py-4 font-semibold">Tanggal Pengajuan</th>
                <th class="px-6 py-4 font-semibold">Status</th>
                <th class="px-6 py-4 font-semibold text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/10 text-sm">
              <tr class="bg-slate-950/40">
                <td class="px-6 py-4 text-slate-200">12 - 14 Mei 2026</td>
                <td class="px-6 py-4 text-slate-300">Cuti Tahunan</td>
                <td class="px-6 py-4 text-slate-300">Kunjungan keluarga</td>
                <td class="px-6 py-4 text-slate-300">2026-05-01</td>
                <td class="px-6 py-4"><span
                    class="rounded-full bg-amber-400/15 px-3 py-1 text-xs font-semibold text-amber-200">Menunggu</span>
                </td>
                <td class="px-6 py-4 text-right"><a href="{{ route('cuti.form') }}"
                    class="rounded-xl border border-cyan-400/20 bg-cyan-400/10 px-3 py-2 text-xs font-semibold text-cyan-200 hover:bg-cyan-400/20">Lihat
                    / Ubah</a></td>
              </tr>
              <tr class="bg-slate-900/60">
                <td class="px-6 py-4 text-slate-200">21 - 22 Apr 2026</td>
                <td class="px-6 py-4 text-slate-300">Cuti Sakit</td>
                <td class="px-6 py-4 text-slate-300">Surat dokter terlampir</td>
                <td class="px-6 py-4 text-slate-300">2026-04-20</td>
                <td class="px-6 py-4"><span
                    class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-200">Disetujui</span>
                </td>
                <td class="px-6 py-4 text-right"><a href="{{ route('cuti.form') }}"
                    class="rounded-xl border border-cyan-400/20 bg-cyan-400/10 px-3 py-2 text-xs font-semibold text-cyan-200 hover:bg-cyan-400/20">Detail</a>
                </td>
              </tr>
              <tr class="bg-slate-950/40">
                <td class="px-6 py-4 text-slate-200">02 - 03 Mar 2026</td>
                <td class="px-6 py-4 text-slate-300">Cuti Khusus</td>
                <td class="px-6 py-4 text-slate-300">Keperluan keluarga</td>
                <td class="px-6 py-4 text-slate-300">2026-02-28</td>
                <td class="px-6 py-4"><span
                    class="rounded-full bg-rose-400/15 px-3 py-1 text-xs font-semibold text-rose-200">Ditolak</span>
                </td>
                <td class="px-6 py-4 text-right"><a href="{{ route('cuti.form') }}"
                    class="rounded-xl border border-cyan-400/20 bg-cyan-400/10 px-3 py-2 text-xs font-semibold text-cyan-200 hover:bg-cyan-400/20">Lihat
                    Alasan</a></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div
          class="flex flex-col gap-4 border-t border-white/10 px-6 py-4 text-sm text-slate-400 sm:flex-row sm:items-center sm:justify-between">
          <p>Menampilkan 3 histori pengajuan cuti.</p>
          <div class="flex items-center gap-2">
            <span class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-slate-200">1</span>
            <span class="rounded-xl border border-white/10 bg-transparent px-3 py-2">2</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
