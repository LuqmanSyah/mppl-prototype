<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengajuan Cuti</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <div class="min-h-screen bg-[linear-gradient(135deg,_#020617_0%,_#0f172a_55%,_#111827_100%)]">
    <div class="mx-auto flex min-h-screen max-w-5xl items-center px-4 py-10 sm:px-6 lg:px-8">
      <div
        class="w-full rounded-3xl border border-white/10 bg-white/5 p-6 shadow-2xl shadow-slate-950/30 backdrop-blur-xl sm:p-8">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-200">Modul Manajemen Cuti</p>
            <h1 class="mt-2 text-3xl font-extrabold text-white">Form Pengajuan Cuti Mandiri</h1>
            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
              Karyawan mengisi rentang tanggal cuti dan alasan pengajuan sebelum mengirim permohonan.
            </p>
          </div>
          <a href="{{ route('cuti.history') }}"
            class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Kembali
            ke Histori</a>
        </div>

        <form action="#" method="post" class="grid gap-5 lg:grid-cols-2">
          @csrf

          <div>
            <label for="jenis_cuti" class="mb-2 block text-sm font-medium text-slate-200">Jenis Cuti</label>
            <select id="jenis_cuti" name="jenis_cuti"
              class="w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-slate-100 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
              <option value="">Pilih jenis cuti</option>
              <option>Cuti Tahunan</option>
              <option>Cuti Sakit</option>
              <option>Cuti Khusus</option>
            </select>
          </div>

          <div>
            <label for="durasi" class="mb-2 block text-sm font-medium text-slate-200">Durasi (hari)</label>
            <input id="durasi" name="durasi" type="number" min="1" placeholder="3"
              class="w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
          </div>

          <div>
            <label for="tanggal_mulai" class="mb-2 block text-sm font-medium text-slate-200">Tanggal Mulai</label>
            <input id="tanggal_mulai" name="tanggal_mulai" type="date"
              class="w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-slate-100 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
          </div>

          <div>
            <label for="tanggal_selesai" class="mb-2 block text-sm font-medium text-slate-200">Tanggal Selesai</label>
            <input id="tanggal_selesai" name="tanggal_selesai" type="date"
              class="w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-slate-100 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10">
          </div>

          <div class="lg:col-span-2">
            <label for="alasan" class="mb-2 block text-sm font-medium text-slate-200">Alasan Pengajuan</label>
            <textarea id="alasan" name="alasan" rows="5" placeholder="Tuliskan alasan pengajuan cuti"
              class="w-full rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10"></textarea>
          </div>

          <div class="lg:col-span-2 flex flex-col gap-3 pt-2 sm:flex-row sm:items-center sm:justify-end">
            <button type="button"
              class="rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Simpan
              Draft</button>
            <button type="submit"
              class="rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-bold text-slate-950 transition hover:brightness-110">Ajukan
              Cuti</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
