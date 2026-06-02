<x-filament-panels::page>
  @php
    $data = $this->getReportData();
    $cards = [
        [
            'label' => 'Laporan Data',
            'title' => 'Daftar Karyawan',
            'description' => 'Ekspor daftar karyawan untuk rekap internal, arsip, atau kebutuhan cetak.',
            'resourceUrl' => \App\Filament\Admin\Resources\EmployeeResource::getUrl(),
            'document' => 'karyawan',
            'badge' => 'Admin HR',
        ],
        [
            'label' => 'Laporan Approval',
            'title' => 'Riwayat Cuti',
            'description' => 'Unduh histori cuti untuk penelusuran persetujuan, penolakan, dan jejak proses.',
            'resourceUrl' => \App\Filament\Admin\Resources\LeaveRequestResource::getUrl(),
            'document' => 'cuti',
            'badge' => 'HR / Manajer',
        ],
        [
            'label' => 'Laporan Gaji',
            'title' => 'Slip Gaji',
            'description' => 'Ekspor slip gaji untuk tinjauan manajemen atau distribusi ke karyawan.',
            'resourceUrl' => \App\Filament\Admin\Resources\PayrollRecordResource::getUrl(),
            'document' => 'gaji',
            'badge' => 'HR / Karyawan',
        ],
    ];
  @endphp

  <div class="grid gap-4 md:grid-cols-3">
    <x-filament::section>
      <p class="text-sm text-gray-500 dark:text-gray-400">Total Karyawan</p>
      <p class="mt-2 text-3xl font-bold tracking-tight">{{ number_format($data['employeeCount']) }}</p>
    </x-filament::section>
    <x-filament::section>
      <p class="text-sm text-gray-500 dark:text-gray-400">Cuti Menunggu</p>
      <p class="mt-2 text-3xl font-bold tracking-tight">{{ number_format($data['pendingLeaveCount']) }}</p>
    </x-filament::section>
    <x-filament::section>
      <p class="text-sm text-gray-500 dark:text-gray-400">Total Gaji Bersih</p>
      <p class="mt-2 text-3xl font-bold tracking-tight">Rp {{ number_format($data['payrollTotal'], 0, ',', '.') }}</p>
    </x-filament::section>
  </div>

  <div class="grid gap-4 lg:grid-cols-3">
    @foreach ($cards as $card)
      <x-filament::section>
        <div class="flex items-start justify-between gap-3">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-primary-600 dark:text-primary-400">
              {{ $card['label'] }}
            </p>
            <h2 class="mt-2 text-lg font-semibold">{{ $card['title'] }}</h2>
          </div>
          <x-filament::badge>{{ $card['badge'] }}</x-filament::badge>
        </div>

        <p class="mt-3 text-sm leading-6 text-gray-600 dark:text-gray-300">{{ $card['description'] }}</p>

        <div class="mt-6 flex flex-wrap gap-2">
          <x-filament::button tag="a" href="{{ \App\Filament\Admin\Pages\ReportPreview::getUrl(['document' => $card['document'], 'format' => 'pdf']) }}">
            Preview PDF
          </x-filament::button>
          <x-filament::button tag="a" color="gray" href="{{ \App\Filament\Admin\Pages\ReportPreview::getUrl(['document' => $card['document'], 'format' => 'excel']) }}">
            Preview Excel
          </x-filament::button>
          <x-filament::button tag="a" color="gray" outlined href="{{ $card['resourceUrl'] }}">
            Buka Data
          </x-filament::button>
        </div>
      </x-filament::section>
    @endforeach
  </div>
</x-filament-panels::page>
