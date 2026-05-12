<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Preview Laporan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
  $titles = [
      'karyawan' => 'Daftar Karyawan',
      'cuti' => 'Riwayat Cuti',
      'gaji' => 'Slip Gaji',
  ];

  $styles = [
      'karyawan' => 'from-cyan-500/20 via-slate-950 to-slate-950',
      'cuti' => 'from-emerald-500/20 via-slate-950 to-slate-950',
      'gaji' => 'from-violet-500/20 via-slate-950 to-slate-950',
  ];
@endphp

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <div class="min-h-screen bg-[linear-gradient(135deg,_#020617_0%,_#0f172a_52%,_#111827_100%)]">
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
      <div
        class="mb-6 flex items-center justify-between rounded-3xl border border-white/10 bg-white/5 px-6 py-4 backdrop-blur">
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Template Cetak PDF</p>
          <h1 class="mt-1 text-2xl font-bold text-white">{{ $titles[$document] }} - {{ strtoupper($format) }}</h1>
        </div>
        <a href="{{ route('laporan.index') }}"
          class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">Kembali</a>
      </div>

      <div
        class="overflow-hidden rounded-[2rem] border border-white/10 bg-white text-slate-900 shadow-[0_30px_90px_rgba(0,0,0,0.45)]">
        @if ($format === 'pdf')
          <div class="bg-gradient-to-r {{ $styles[$document] }} px-8 py-7 text-white">
            <div class="flex items-start justify-between gap-6">
              <div>
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/70">Dokumen Export</p>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight">{{ $titles[$document] }}</h2>
                <p class="mt-2 text-sm text-white/80">Acuan visual untuk penyusunan PDF export.</p>
              </div>
              <div class="rounded-2xl bg-white/15 px-4 py-3 text-right">
                <p class="text-[10px] font-semibold uppercase tracking-[0.24em] text-white/70">Format</p>
                <p class="text-sm font-bold">PDF</p>
              </div>
            </div>
          </div>

          <div class="p-8">
            @if ($document === 'karyawan')
              <div class="mb-4 flex items-center justify-between">
                <div>
                  <p class="text-sm font-semibold text-slate-500">Periode: Mei 2026</p>
                  <p class="text-sm text-slate-500">Dicetak oleh Admin HR</p>
                </div>
                <div class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600">PT
                  Contoh Abadi</div>
              </div>
              <table class="w-full border-collapse text-sm">
                <thead>
                  <tr class="border-b-2 border-slate-900 bg-slate-100 text-left">
                    <th class="px-4 py-3">NIK</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Jabatan</th>
                    <th class="px-4 py-3">Departemen</th>
                    <th class="px-4 py-3">Tanggal Masuk</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b border-slate-200">
                    <td class="px-4 py-3">EMP-0001</td>
                    <td class="px-4 py-3">Ayu Permata Sari</td>
                    <td class="px-4 py-3">HR Officer</td>
                    <td class="px-4 py-3">Human Resource</td>
                    <td class="px-4 py-3">2024-01-10</td>
                  </tr>
                  <tr class="border-b border-slate-200 bg-slate-50">
                    <td class="px-4 py-3">EMP-0002</td>
                    <td class="px-4 py-3">Bima Pratama</td>
                    <td class="px-4 py-3">Supervisor</td>
                    <td class="px-4 py-3">Operasional</td>
                    <td class="px-4 py-3">2023-09-18</td>
                  </tr>
                </tbody>
              </table>
            @elseif ($document === 'cuti')
              <div class="mb-4 flex items-center justify-between">
                <div>
                  <p class="text-sm font-semibold text-slate-500">Ringkasan Histori</p>
                  <p class="text-sm text-slate-500">Status: menunggu, disetujui, ditolak</p>
                </div>
                <div class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600">Approval
                  Log</div>
              </div>
              <table class="w-full border-collapse text-sm">
                <thead>
                  <tr class="border-b-2 border-slate-900 bg-slate-100 text-left">
                    <th class="px-4 py-3">Periode</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Alasan</th>
                    <th class="px-4 py-3">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b border-slate-200">
                    <td class="px-4 py-3">12 - 14 Mei 2026</td>
                    <td class="px-4 py-3">Cuti Tahunan</td>
                    <td class="px-4 py-3">Kunjungan keluarga</td>
                    <td class="px-4 py-3">Menunggu</td>
                  </tr>
                  <tr class="border-b border-slate-200 bg-slate-50">
                    <td class="px-4 py-3">21 - 22 Apr 2026</td>
                    <td class="px-4 py-3">Cuti Sakit</td>
                    <td class="px-4 py-3">Surat dokter terlampir</td>
                    <td class="px-4 py-3">Disetujui</td>
                  </tr>
                </tbody>
              </table>
            @else
              <div class="mb-4 flex items-center justify-between">
                <div>
                  <p class="text-sm font-semibold text-slate-500">Slip Gaji Bulanan</p>
                  <p class="text-sm text-slate-500">Rumus: gaji pokok + tunjangan - potongan kehadiran</p>
                </div>
                <div class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600">Mei 2026
                </div>
              </div>
              <table class="w-full border-collapse text-sm">
                <thead>
                  <tr class="border-b-2 border-slate-900 bg-slate-100 text-left">
                    <th class="px-4 py-3">Komponen</th>
                    <th class="px-4 py-3 text-right">Nominal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b border-slate-200">
                    <td class="px-4 py-3">Gaji Pokok</td>
                    <td class="px-4 py-3 text-right">Rp 6.500.000</td>
                  </tr>
                  <tr class="border-b border-slate-200 bg-slate-50">
                    <td class="px-4 py-3">Tunjangan</td>
                    <td class="px-4 py-3 text-right">Rp 1.250.000</td>
                  </tr>
                  <tr class="border-b border-slate-200">
                    <td class="px-4 py-3">Potongan Kehadiran</td>
                    <td class="px-4 py-3 text-right">- Rp 150.000</td>
                  </tr>
                  <tr class="bg-slate-100 font-bold">
                    <td class="px-4 py-3">Gaji Bersih</td>
                    <td class="px-4 py-3 text-right">Rp 7.600.000</td>
                  </tr>
                </tbody>
              </table>
            @endif
          </div>
        @else
          <div class="bg-gradient-to-r {{ $styles[$document] }} px-8 py-6 text-white">
            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/70">Preview Spreadsheet</p>
            <h2 class="mt-2 text-2xl font-extrabold">{{ $titles[$document] }} - EXCEL</h2>
            <p class="mt-2 text-sm text-white/80">Representasi layout tabel untuk export Excel.</p>
          </div>

          <div class="p-8">
            <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
              <span>Sheet: {{ $titles[$document] }}</span>
              <span>Format: XLSX</span>
            </div>

            @if ($document === 'karyawan')
              <table class="w-full border-collapse text-sm">
                <thead>
                  <tr class="bg-slate-100 text-left">
                    <th class="border border-slate-300 px-3 py-2">NIK</th>
                    <th class="border border-slate-300 px-3 py-2">Nama</th>
                    <th class="border border-slate-300 px-3 py-2">Jabatan</th>
                    <th class="border border-slate-300 px-3 py-2">Departemen</th>
                    <th class="border border-slate-300 px-3 py-2">Tanggal Masuk</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="border border-slate-300 px-3 py-2">EMP-0001</td>
                    <td class="border border-slate-300 px-3 py-2">Ayu Permata Sari</td>
                    <td class="border border-slate-300 px-3 py-2">HR Officer</td>
                    <td class="border border-slate-300 px-3 py-2">Human Resource</td>
                    <td class="border border-slate-300 px-3 py-2">2024-01-10</td>
                  </tr>
                  <tr class="bg-slate-50">
                    <td class="border border-slate-300 px-3 py-2">EMP-0002</td>
                    <td class="border border-slate-300 px-3 py-2">Bima Pratama</td>
                    <td class="border border-slate-300 px-3 py-2">Supervisor</td>
                    <td class="border border-slate-300 px-3 py-2">Operasional</td>
                    <td class="border border-slate-300 px-3 py-2">2023-09-18</td>
                  </tr>
                </tbody>
              </table>
            @elseif ($document === 'cuti')
              <table class="w-full border-collapse text-sm">
                <thead>
                  <tr class="bg-slate-100 text-left">
                    <th class="border border-slate-300 px-3 py-2">Periode</th>
                    <th class="border border-slate-300 px-3 py-2">Jenis Cuti</th>
                    <th class="border border-slate-300 px-3 py-2">Alasan</th>
                    <th class="border border-slate-300 px-3 py-2">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="border border-slate-300 px-3 py-2">12 - 14 Mei 2026</td>
                    <td class="border border-slate-300 px-3 py-2">Cuti Tahunan</td>
                    <td class="border border-slate-300 px-3 py-2">Kunjungan keluarga</td>
                    <td class="border border-slate-300 px-3 py-2">Menunggu</td>
                  </tr>
                  <tr class="bg-slate-50">
                    <td class="border border-slate-300 px-3 py-2">21 - 22 Apr 2026</td>
                    <td class="border border-slate-300 px-3 py-2">Cuti Sakit</td>
                    <td class="border border-slate-300 px-3 py-2">Surat dokter terlampir</td>
                    <td class="border border-slate-300 px-3 py-2">Disetujui</td>
                  </tr>
                </tbody>
              </table>
            @else
              <table class="w-full border-collapse text-sm">
                <thead>
                  <tr class="bg-slate-100 text-left">
                    <th class="border border-slate-300 px-3 py-2">Komponen</th>
                    <th class="border border-slate-300 px-3 py-2 text-right">Nominal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="border border-slate-300 px-3 py-2">Gaji Pokok</td>
                    <td class="border border-slate-300 px-3 py-2 text-right">Rp 6.500.000</td>
                  </tr>
                  <tr class="bg-slate-50">
                    <td class="border border-slate-300 px-3 py-2">Tunjangan</td>
                    <td class="border border-slate-300 px-3 py-2 text-right">Rp 1.250.000</td>
                  </tr>
                  <tr>
                    <td class="border border-slate-300 px-3 py-2">Potongan Kehadiran</td>
                    <td class="border border-slate-300 px-3 py-2 text-right">- Rp 150.000</td>
                  </tr>
                  <tr class="bg-slate-100 font-bold">
                    <td class="border border-slate-300 px-3 py-2">Gaji Bersih</td>
                    <td class="border border-slate-300 px-3 py-2 text-right">Rp 7.600.000</td>
                  </tr>
                </tbody>
              </table>
            @endif
          </div>
        @endif
      </div>
    </div>
  </div>
</body>

</html>
