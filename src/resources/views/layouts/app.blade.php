<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $pageTitle ?? 'MPPL HR Portal' }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
  $role = request()->query('role', $role ?? 'admin-hr');

  $roleLabels = [
      'admin-hr' => 'Admin HR',
      'manager' => 'Manajer',
      'employee' => 'Karyawan',
  ];

  $roleMenu = [
      'admin-hr' => [
          ['label' => 'Dasbor', 'route' => 'dashboard', 'href' => route('dashboard', ['role' => 'admin-hr'])],
          ['label' => 'Karyawan', 'route' => 'karyawan.index', 'href' => route('karyawan.index')],
          ['label' => 'Cuti', 'route' => 'cuti.history', 'href' => route('cuti.history')],
          ['label' => 'Penggajian', 'route' => 'penggajian.index', 'href' => route('penggajian.index')],
          ['label' => 'Laporan', 'route' => 'laporan.index', 'href' => route('laporan.index')],
      ],
      'manager' => [
          ['label' => 'Dasbor', 'route' => 'dashboard', 'href' => route('dashboard', ['role' => 'manager'])],
          ['label' => 'Approval Cuti', 'route' => 'cuti.approval', 'href' => route('cuti.approval')],
          ['label' => 'Laporan', 'route' => 'laporan.index', 'href' => route('laporan.index')],
          ['label' => 'Slip Gaji', 'route' => 'penggajian.slip', 'href' => route('penggajian.slip')],
      ],
      'employee' => [
          ['label' => 'Dasbor', 'route' => 'dashboard', 'href' => route('dashboard', ['role' => 'employee'])],
          ['label' => 'Histori Cuti', 'route' => 'cuti.history', 'href' => route('cuti.history')],
          ['label' => 'Ajukan Cuti', 'route' => 'cuti.form', 'href' => route('cuti.form')],
          ['label' => 'Slip Gaji', 'route' => 'penggajian.slip', 'href' => route('penggajian.slip')],
      ],
  ];

  $activeMenu = $roleMenu[$role] ?? $roleMenu['admin-hr'];
  $currentRoleLabel = $roleLabels[$role] ?? $roleLabels['admin-hr'];

  $roleSwitchLinks = [
      'admin-hr' => route('dashboard', ['role' => 'admin-hr']),
      'manager' => route('dashboard', ['role' => 'manager']),
      'employee' => route('dashboard', ['role' => 'employee']),
  ];
@endphp

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <div
    class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(14,165,233,0.18),_transparent_28%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.14),_transparent_24%),linear-gradient(135deg,_#020617_0%,_#0f172a_52%,_#111827_100%)]">
    <div class="mx-auto flex min-h-screen max-w-[1600px] gap-6 px-4 py-4 sm:px-6 lg:px-8">
      <aside aria-label="Sidebar navigasi utama"
        class="hidden w-72 shrink-0 rounded-3xl border border-white/10 bg-slate-900/75 p-5 shadow-[0_24px_80px_rgba(0,0,0,0.35)] backdrop-blur-xl lg:flex lg:flex-col">
        <div class="rounded-2xl border border-cyan-400/20 bg-cyan-400/10 p-4">
          <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-200">MPPL HR Portal</p>
          <h1 class="mt-2 text-xl font-bold text-white">Shared Layout</h1>
          <p class="mt-2 text-sm leading-6 text-slate-300">Navigasi menyesuaikan role aktif secara otomatis.</p>
        </div>

        <nav aria-label="Navigasi modul berdasarkan role aktif" class="mt-6 space-y-2">
          @foreach ($activeMenu as $item)
            <a href="{{ $item['href'] }}"
              class="flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs($item['route']) ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
              <span>{{ $item['label'] }}</span>
              <span class="text-xs opacity-60">→</span>
            </a>
          @endforeach
        </nav>

        <div class="mt-auto rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-slate-300">
          <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Role Aktif</p>
          <p class="mt-2 text-lg font-semibold text-white">{{ $currentRoleLabel }}</p>
          <p class="mt-2 leading-6">Gunakan tombol switch di header untuk melihat tampilan role lain pada prototipe ini.
          </p>
        </div>
      </aside>

      <div class="flex min-w-0 flex-1 flex-col gap-6">
        <header
          class="rounded-3xl border border-white/10 bg-slate-900/75 px-5 py-4 shadow-[0_24px_80px_rgba(0,0,0,0.28)] backdrop-blur-xl sm:px-6">
          <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-4">
              <div
                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 to-violet-400 text-sm font-black text-slate-950">
                MP</div>
              <div>
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Dashboard Utama</p>
                <h2 class="text-lg font-bold text-white">{{ $pageTitle ?? 'MPPL HR Portal' }}</h2>
              </div>
            </div>

            <div class="flex flex-wrap items-center gap-2">
              @foreach ($roleSwitchLinks as $switchRole => $switchHref)
                <a href="{{ $switchHref }}"
                  class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $role === $switchRole ? 'bg-white text-slate-950' : 'border border-white/10 bg-white/5 text-slate-300 hover:bg-white/10 hover:text-white' }}">
                  {{ $roleLabels[$switchRole] }}
                </a>
              @endforeach
            </div>
          </div>
        </header>

        <div class="flex flex-1 flex-col gap-6 lg:flex-row">
          <aside aria-label="Navigasi utama mobile"
            class="rounded-3xl border border-white/10 bg-slate-900/75 p-4 shadow-[0_24px_80px_rgba(0,0,0,0.28)] backdrop-blur-xl lg:hidden">
            <div class="mb-3 flex items-center justify-between">
              <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Navigasi</p>
              <span
                class="rounded-full bg-white/5 px-3 py-1 text-xs font-semibold text-slate-200">{{ $currentRoleLabel }}</span>
            </div>
            <nav aria-label="Navigasi modul mobile" class="grid gap-2 sm:grid-cols-2">
              @foreach ($activeMenu as $item)
                <a href="{{ $item['href'] }}"
                  class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-white/10">{{ $item['label'] }}</a>
              @endforeach
            </nav>
          </aside>

          <main class="min-w-0 flex-1">
            @yield('content')
          </main>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
