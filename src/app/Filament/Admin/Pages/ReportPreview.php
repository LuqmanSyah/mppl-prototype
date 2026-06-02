<?php

namespace App\Filament\Admin\Pages;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\PayrollRecord;
use Filament\Pages\Page;

class ReportPreview extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Preview Laporan';

    protected static ?string $slug = 'laporan/preview';

    protected static string $view = 'filament.admin.pages.report-preview';

    public string $document;

    public string $format;

    public function mount(): void
    {
        $this->document = request()->query('document', 'karyawan');
        $this->format = request()->query('format', 'pdf');

        abort_unless(in_array($this->document, ['karyawan', 'cuti', 'gaji'], true), 404);
        abort_unless(in_array($this->format, ['pdf', 'excel'], true), 404);
    }

    public function getHeading(): string
    {
        return $this->titleFor($this->document) . ' - ' . strtoupper($this->format);
    }

    public function titleFor(string $document): string
    {
        return [
            'karyawan' => 'Daftar Karyawan',
            'cuti' => 'Riwayat Cuti',
            'gaji' => 'Slip Gaji',
        ][$document];
    }

    public function getRows()
    {
        return match ($this->document) {
            'karyawan' => Employee::query()->latest()->limit(20)->get(),
            'cuti' => LeaveRequest::query()->with('employee')->latest()->limit(20)->get(),
            'gaji' => PayrollRecord::query()->with('employee')->latest()->limit(20)->get(),
        };
    }

    public function rupiah(mixed $amount): string
    {
        return 'Rp ' . number_format((float) $amount, 0, ',', '.');
    }
}
