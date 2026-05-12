@extends('layouts.app')

@php
  $role = request()->query('role', $role ?? 'admin-hr');

  $heroCopy = [
      'admin-hr' => [
          'title' => 'Selamat datang, Admin HR',
          'description' =>
              'Pantau data utama operasional HR dari satu panel ringkas: karyawan, cuti, penggajian, dan laporan.',
      ],
      'manager' => [
          'title' => 'Selamat datang, Manajer',
          'description' =>
              'Kelola antrean cuti, lihat ringkasan tim, dan akses laporan yang relevan dari dashboard ini.',
      ],
      'employee' => [
          'title' => 'Selamat datang, Karyawan',
          'description' => 'Lihat ringkasan cuti dan slip gaji pribadi melalui homepage setelah login.',
      ],
  ][$role] ?? [
      'title' => 'Selamat datang',
      'description' => 'Panel utama menyesuaikan menu dan ringkasan berdasarkan role aktif.',
  ];

  $stats =
      [
          'admin-hr' => [
              ['label' => 'Total Karyawan', 'value' => '128', 'note' => '+6 bulan ini', 'tone' => 'cyan'],
              ['label' => 'Cuti Menunggu', 'value' => '14', 'note' => 'Perlu tindak lanjut', 'tone' => 'amber'],
              ['label' => 'Batch Gaji', 'value' => '3', 'note' => 'Siap diproses', 'tone' => 'violet'],
          ],
          'manager' => [
              ['label' => 'Antrean Cuti', 'value' => '9', 'note' => 'Belum direspons', 'tone' => 'amber'],
              ['label' => 'Tim Aktif', 'value' => '24', 'note' => 'Dalam pengawasan', 'tone' => 'cyan'],
              ['label' => 'Laporan Dibuka', 'value' => '5', 'note' => 'Minggu ini', 'tone' => 'violet'],
          ],
          'employee' => [
              ['label' => 'Sisa Cuti', 'value' => '8 Hari', 'note' => 'Tahun berjalan', 'tone' => 'emerald'],
              ['label' => 'Pengajuan Aktif', 'value' => '2', 'note' => 'Menunggu keputusan', 'tone' => 'amber'],
              ['label' => 'Slip Terbaru', 'value' => 'Mei 2026', 'note' => 'Sudah tersedia', 'tone' => 'violet'],
          ],
      ][$role] ?? [];
@endphp

@section('content')
  <div class="grid gap-6 xl:grid-cols-[1.35fr_0.65fr]">
    <section
      class="rounded-3xl border border-white/10 bg-slate-900/75 p-6 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl sm:p-8">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Homepage Role-Based</p>
          <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white sm:text-4xl">{{ $heroCopy['title'] }}</h1>
          <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 sm:text-base">{{ $heroCopy['description'] }}</p>
        </div>

        <div class="rounded-3xl border border-white/10 bg-white/5 p-4 text-right">
          <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Role Aktif</p>
          <p class="mt-2 text-lg font-bold text-white">
            {{ $role === 'admin-hr' ? 'Admin HR' : ($role === 'manager' ? 'Manajer' : 'Karyawan') }}</p>
        </div>
      </div>

      <div class="mt-8 grid gap-4 sm:grid-cols-3">
        @foreach ($stats as $stat)
          <div class="rounded-3xl border border-white/10 bg-slate-950/50 p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">{{ $stat['label'] }}</p>
            <p class="mt-3 text-3xl font-extrabold text-white">{{ $stat['value'] }}</p>
            <p class="mt-2 text-sm text-slate-400">{{ $stat['note'] }}</p>
          </div>
        @endforeach
      </div>

      <div class="mt-8 rounded-3xl border border-white/10 bg-white/5 p-5">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
          <div>
            <p class="text-sm font-semibold text-white">Pintasan Modul</p>
            <p class="mt-1 text-sm text-slate-400">Navigasi cepat ke area yang paling sering dipakai sesuai role.</p>
          </div>
          <div class="flex flex-wrap gap-2">
            <a href="{{ route('karyawan.index') }}"
              class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-white/10">Karyawan</a>
            <a href="{{ route('cuti.history') }}"
              class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-white/10">Cuti</a>
            <a href="{{ route('penggajian.index') }}"
              class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-white/10">Penggajian</a>
            <a href="{{ route('laporan.index') }}"
              class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-white/10">Laporan</a>
          </div>
        </div>
      </div>
    </section>

    <section class="space-y-6">
      <div
        class="rounded-3xl border border-white/10 bg-slate-900/75 p-6 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Menu Navigasi Global</p>
        <div class="mt-4 space-y-3">
          @foreach (['admin-hr' => 'Admin HR', 'manager' => 'Manajer', 'employee' => 'Karyawan'] as $roleKey => $label)
            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
              <div class="flex items-center justify-between gap-3">
                <div>
                  <p class="font-semibold text-white">{{ $label }}</p>
                  <p class="mt-1 text-sm text-slate-400">
                    {{ $roleKey === 'admin-hr' ? 'Karyawan, cuti, penggajian, laporan' : ($roleKey === 'manager' ? 'Approval cuti dan laporan' : 'Cuti dan slip gaji pribadi') }}
                  </p>
                </div>
                <a href="{{ route('dashboard', ['role' => $roleKey]) }}"
                  class="rounded-full border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-200 transition hover:bg-white/10">Lihat</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div
        class="rounded-3xl border border-white/10 bg-slate-900/75 p-6 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Catatan Prototype</p>
        <p class="mt-3 text-sm leading-6 text-slate-300">
          Layout ini berfungsi sebagai shared shell untuk homepage dan navigasi antar modul. Visibilitas menu di sidebar
          mengikuti role aktif yang dipilih melalui switch di header.
        </p>
      </div>
    </section>
  </div>
@endsection
