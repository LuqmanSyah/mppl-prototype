<?php

namespace App\Filament\Admin\Pages;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\PayrollRecord;
use Filament\Pages\Page;

class ReportCenter extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?string $navigationLabel = 'Pusat Laporan';

    protected static ?string $title = 'Pusat Laporan';

    protected static ?string $slug = 'laporan';

    protected static string $view = 'filament.admin.pages.report-center';

    protected static ?int $navigationSort = 1;

    public function getReportData(): array
    {
        return [
            'employeeCount' => Employee::query()->count(),
            'pendingLeaveCount' => LeaveRequest::query()->where('status', 'Menunggu')->count(),
            'payrollTotal' => PayrollRecord::query()->get()->sum('net_salary'),
            'latestEmployees' => Employee::query()->latest()->limit(5)->get(),
            'latestLeaves' => LeaveRequest::query()->with('employee')->latest()->limit(5)->get(),
            'latestPayrolls' => PayrollRecord::query()->with('employee')->latest()->limit(5)->get(),
        ];
    }
}
