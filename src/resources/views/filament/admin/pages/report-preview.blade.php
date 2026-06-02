<x-filament-panels::page>
  @php($rows = $this->getRows())

  <x-filament::section>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
      <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Template {{ strtoupper($this->format) }}</p>
        <h2 class="mt-1 text-xl font-semibold">{{ $this->titleFor($this->document) }}</h2>
      </div>
      <x-filament::button tag="a" color="gray" href="{{ \App\Filament\Admin\Pages\ReportCenter::getUrl() }}">
        Kembali
      </x-filament::button>
    </div>

    <div class="mt-6 overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
      @if ($this->document === 'karyawan')
        <table class="w-full min-w-[720px] divide-y divide-gray-200 text-sm dark:divide-gray-700">
          <thead class="bg-gray-50 text-left dark:bg-gray-900">
            <tr>
              <th class="px-4 py-3 font-semibold">NIK</th>
              <th class="px-4 py-3 font-semibold">Nama</th>
              <th class="px-4 py-3 font-semibold">Jabatan</th>
              <th class="px-4 py-3 font-semibold">Departemen</th>
              <th class="px-4 py-3 font-semibold">Tanggal Masuk</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($rows as $employee)
              <tr>
                <td class="px-4 py-3">{{ $employee->nik }}</td>
                <td class="px-4 py-3">{{ $employee->name }}</td>
                <td class="px-4 py-3">{{ $employee->position }}</td>
                <td class="px-4 py-3">{{ $employee->department }}</td>
                <td class="px-4 py-3">{{ $employee->joined_at?->format('Y-m-d') }}</td>
              </tr>
            @empty
              <tr>
                <td class="px-4 py-6 text-center text-gray-500" colspan="5">Belum ada data karyawan.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      @elseif ($this->document === 'cuti')
        <table class="w-full min-w-[720px] divide-y divide-gray-200 text-sm dark:divide-gray-700">
          <thead class="bg-gray-50 text-left dark:bg-gray-900">
            <tr>
              <th class="px-4 py-3 font-semibold">Karyawan</th>
              <th class="px-4 py-3 font-semibold">Periode</th>
              <th class="px-4 py-3 font-semibold">Jenis</th>
              <th class="px-4 py-3 font-semibold">Alasan</th>
              <th class="px-4 py-3 font-semibold">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($rows as $leave)
              <tr>
                <td class="px-4 py-3">{{ $leave->employee?->name }}</td>
                <td class="px-4 py-3">{{ $leave->start_date?->format('d M Y') }} - {{ $leave->end_date?->format('d M Y') }}</td>
                <td class="px-4 py-3">{{ $leave->leave_type }}</td>
                <td class="px-4 py-3">{{ $leave->reason }}</td>
                <td class="px-4 py-3">{{ $leave->status }}</td>
              </tr>
            @empty
              <tr>
                <td class="px-4 py-6 text-center text-gray-500" colspan="5">Belum ada data cuti.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      @else
        <table class="w-full min-w-[720px] divide-y divide-gray-200 text-sm dark:divide-gray-700">
          <thead class="bg-gray-50 text-left dark:bg-gray-900">
            <tr>
              <th class="px-4 py-3 font-semibold">Karyawan</th>
              <th class="px-4 py-3 font-semibold">Periode</th>
              <th class="px-4 py-3 font-semibold text-right">Gaji Pokok</th>
              <th class="px-4 py-3 font-semibold text-right">Tunjangan</th>
              <th class="px-4 py-3 font-semibold text-right">Potongan</th>
              <th class="px-4 py-3 font-semibold text-right">Gaji Bersih</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($rows as $payroll)
              <tr>
                <td class="px-4 py-3">{{ $payroll->employee?->name }}</td>
                <td class="px-4 py-3">{{ $payroll->period }}</td>
                <td class="px-4 py-3 text-right">{{ $this->rupiah($payroll->base_salary) }}</td>
                <td class="px-4 py-3 text-right">{{ $this->rupiah($payroll->allowance) }}</td>
                <td class="px-4 py-3 text-right">{{ $this->rupiah($payroll->attendance_deduction) }}</td>
                <td class="px-4 py-3 text-right font-semibold">{{ $this->rupiah($payroll->net_salary) }}</td>
              </tr>
            @empty
              <tr>
                <td class="px-4 py-6 text-center text-gray-500" colspan="6">Belum ada data gaji.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      @endif
    </div>
  </x-filament::section>
</x-filament-panels::page>
