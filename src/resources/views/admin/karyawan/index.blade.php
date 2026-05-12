<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Karyawan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <div
    class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.22),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(34,197,94,0.14),_transparent_26%),linear-gradient(135deg,_#020617_0%,_#0f172a_52%,_#111827_100%)]">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
      <div
        class="mb-8 flex flex-col gap-4 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/30 backdrop-blur lg:flex-row lg:items-end lg:justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-200">Modul Manajemen Karyawan</p>
          <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Daftar Karyawan</h1>
          <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
            Tampilan ini menampilkan tabel utama data karyawan untuk akses Admin HR, lengkap dengan aksi tambah, edit,
            dan hapus.
          </p>
        </div>

        <div class="flex flex-wrap gap-3">
          <a href="{{ route('karyawan.create') }}"
            class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 transition hover:brightness-110">Tambah
            Karyawan</a>
          <a href="{{ route('karyawan.form') }}"
            class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Edit
            Contoh</a>
        </div>
      </div>

      <div
        class="overflow-hidden rounded-3xl border border-white/10 bg-slate-900/70 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl">
        <div class="border-b border-white/10 px-6 py-4">
          <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
              <h2 class="text-lg font-semibold text-white">Tabel Karyawan</h2>
              <p class="mt-1 text-sm text-slate-400">NIK, nama, jabatan, departemen, dan tanggal masuk.</p>
            </div>
            <div class="grid gap-3 sm:grid-cols-3">
              <input type="text" placeholder="Cari karyawan..."
                class="rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 placeholder:text-slate-500 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
              <select
                class="rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
                <option>Semua Departemen</option>
                <option>HR</option>
                <option>Finance</option>
                <option>Operasional</option>
              </select>
              <select
                class="rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
                <option>Semua Jabatan</option>
                <option>Staff</option>
                <option>Supervisor</option>
                <option>Manager</option>
              </select>
            </div>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-white/10">
            <thead class="bg-white/5 text-left text-xs uppercase tracking-[0.22em] text-slate-400">
              <tr>
                <th class="px-6 py-4 font-semibold">NIK</th>
                <th class="px-6 py-4 font-semibold">Nama</th>
                <th class="px-6 py-4 font-semibold">Jabatan</th>
                <th class="px-6 py-4 font-semibold">Departemen</th>
                <th class="px-6 py-4 font-semibold">Tanggal Masuk</th>
                <th class="px-6 py-4 font-semibold text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/10 text-sm">
              <tr class="bg-slate-950/40">
                <td class="px-6 py-4 font-medium text-white">EMP-0001</td>
                <td class="px-6 py-4 text-slate-200">Ayu Permata Sari</td>
                <td class="px-6 py-4 text-slate-300">HR Officer</td>
                <td class="px-6 py-4 text-slate-300">Human Resource</td>
                <td class="px-6 py-4 text-slate-300">2024-01-10</td>
                <td class="px-6 py-4">
                  <div class="flex justify-end gap-2">
                    <a href="{{ route('karyawan.form') }}"
                      class="rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-3 py-2 text-xs font-semibold text-emerald-200 hover:bg-emerald-400/20">Edit</a>
                    <a href="{{ route('karyawan.delete') }}"
                      class="rounded-xl border border-rose-400/20 bg-rose-400/10 px-3 py-2 text-xs font-semibold text-rose-200 hover:bg-rose-400/20">Hapus</a>
                  </div>
                </td>
              </tr>
              <tr class="bg-slate-900/60">
                <td class="px-6 py-4 font-medium text-white">EMP-0002</td>
                <td class="px-6 py-4 text-slate-200">Bima Pratama</td>
                <td class="px-6 py-4 text-slate-300">Supervisor</td>
                <td class="px-6 py-4 text-slate-300">Operasional</td>
                <td class="px-6 py-4 text-slate-300">2023-09-18</td>
                <td class="px-6 py-4">
                  <div class="flex justify-end gap-2">
                    <a href="{{ route('karyawan.form') }}"
                      class="rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-3 py-2 text-xs font-semibold text-emerald-200 hover:bg-emerald-400/20">Edit</a>
                    <a href="{{ route('karyawan.delete') }}"
                      class="rounded-xl border border-rose-400/20 bg-rose-400/10 px-3 py-2 text-xs font-semibold text-rose-200 hover:bg-rose-400/20">Hapus</a>
                  </div>
                </td>
              </tr>
              <tr class="bg-slate-950/40">
                <td class="px-6 py-4 font-medium text-white">EMP-0003</td>
                <td class="px-6 py-4 text-slate-200">Citra Lestari</td>
                <td class="px-6 py-4 text-slate-300">Finance Staff</td>
                <td class="px-6 py-4 text-slate-300">Finance</td>
                <td class="px-6 py-4 text-slate-300">2022-11-05</td>
                <td class="px-6 py-4">
                  <div class="flex justify-end gap-2">
                    <a href="{{ route('karyawan.form') }}"
                      class="rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-3 py-2 text-xs font-semibold text-emerald-200 hover:bg-emerald-400/20">Edit</a>
                    <a href="{{ route('karyawan.delete') }}"
                      class="rounded-xl border border-rose-400/20 bg-rose-400/10 px-3 py-2 text-xs font-semibold text-rose-200 hover:bg-rose-400/20">Hapus</a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div
          class="flex flex-col gap-4 border-t border-white/10 px-6 py-4 text-sm text-slate-400 sm:flex-row sm:items-center sm:justify-between">
          <p>Menampilkan 3 dari 3 karyawan.</p>
          <div class="flex items-center gap-2">
            <span class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-slate-200">1</span>
            <span class="rounded-xl border border-white/10 bg-transparent px-3 py-2">2</span>
            <span class="rounded-xl border border-white/10 bg-transparent px-3 py-2">3</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
