<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Konfirmasi Hapus Karyawan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <div
    class="flex min-h-screen items-center justify-center bg-[radial-gradient(circle_at_top,_rgba(244,63,94,0.18),_transparent_28%),linear-gradient(135deg,_#020617_0%,_#0f172a_55%,_#111827_100%)] px-4 py-10">
    <div
      class="w-full max-w-md rounded-3xl border border-rose-400/20 bg-slate-900/90 p-6 shadow-[0_30px_80px_rgba(0,0,0,0.45)] backdrop-blur-xl">
      <div class="flex items-start gap-4">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-400/15 text-rose-200">
          <span class="text-xl font-black">!</span>
        </div>
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.3em] text-rose-200">Konfirmasi Hapus</p>
          <h1 class="mt-2 text-2xl font-bold text-white">Hapus data karyawan?</h1>
          <p class="mt-3 text-sm leading-6 text-slate-300">
            Tindakan ini akan menghapus data karyawan dari sistem. Pastikan data yang dipilih sudah benar sebelum
            dilanjutkan.
          </p>
        </div>
      </div>

      <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-4 text-sm leading-6 text-slate-300">
        <p class="font-semibold text-white">Data yang akan dihapus</p>
        <p class="mt-1">NIK: EMP-0002</p>
        <p>Nama: Bima Pratama</p>
        <p>Jabatan: Supervisor</p>
      </div>

      <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
        <a href="{{ route('karyawan.index') }}"
          class="rounded-2xl border border-white/10 bg-white/5 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-white/10">Batal</a>
        <button type="button"
          class="rounded-2xl bg-rose-500 px-5 py-3 text-sm font-bold text-white transition hover:brightness-110">Ya,
          Hapus</button>
      </div>
    </div>
  </div>
</body>

</html>
