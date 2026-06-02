<?php

use App\Filament\Admin\Pages\ReportPreview;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\PayrollRecord;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', function () {
    return view('landing', [
        'employeeCount' => Schema::hasTable('employees') ? Employee::query()->count() : 0,
        'pendingLeaveCount' => Schema::hasTable('leave_requests') ? LeaveRequest::query()->where('status', 'Menunggu')->count() : 0,
        'payrollCount' => Schema::hasTable('payroll_records') ? PayrollRecord::query()->count() : 0,
    ]);
});

Route::redirect('/dashboard', '/')->name('dashboard');
Route::redirect('/karyawan', '/admin/karyawan')->name('karyawan.index');
Route::redirect('/karyawan/form', '/admin/karyawan/create')->name('karyawan.form');
Route::redirect('/karyawan/create', '/admin/karyawan/create')->name('karyawan.create');
Route::redirect('/karyawan/delete', '/admin/karyawan')->name('karyawan.delete');
Route::redirect('/cuti', '/admin/cuti')->name('cuti.history');
Route::redirect('/cuti/pengajuan', '/admin/cuti/create')->name('cuti.form');
Route::redirect('/cuti/approval', '/admin/cuti')->name('cuti.approval');
Route::redirect('/penggajian', '/admin/penggajian')->name('penggajian.index');
Route::redirect('/penggajian/slip', '/admin/penggajian')->name('penggajian.slip');
Route::redirect('/laporan', '/admin/laporan')->name('laporan.index');
Route::get('/laporan/preview/{document}/{format}', function (string $document, string $format) {
    abort_unless(in_array($document, ['karyawan', 'cuti', 'gaji'], true), 404);
    abort_unless(in_array($format, ['pdf', 'excel'], true), 404);

    return redirect(ReportPreview::getUrl([
        'document' => $document,
        'format' => $format,
    ]));
})->name('laporan.preview');
