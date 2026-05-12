<?php

use Illuminate\Support\Facades\Route;
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
    return view('dashboard', [
        'role' => request()->query('role', 'admin-hr'),
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'role' => request()->query('role', 'admin-hr'),
    ]);
})->name('dashboard');

Route::view('/login-demo', 'auth.login')->name('login.demo');

Route::view('/karyawan', 'admin.karyawan.index')->name('karyawan.index');
Route::view('/karyawan/form', 'admin.karyawan.form')->name('karyawan.form');
Route::view('/karyawan/create', 'admin.karyawan.form')->name('karyawan.create');
Route::view('/karyawan/delete', 'admin.karyawan.delete')->name('karyawan.delete');

Route::view('/cuti', 'admin.cuti.history')->name('cuti.history');
Route::view('/cuti/pengajuan', 'admin.cuti.form')->name('cuti.form');
Route::view('/cuti/approval', 'admin.cuti.approval')->name('cuti.approval');

Route::view('/penggajian', 'admin.penggajian.index')->name('penggajian.index');
Route::view('/penggajian/slip', 'admin.penggajian.slip')->name('penggajian.slip');

Route::view('/laporan', 'admin.laporan.index')->name('laporan.index');
Route::get('/laporan/preview/{document}/{format}', function (string $document, string $format) {
    abort_unless(in_array($document, ['karyawan', 'cuti', 'gaji'], true), 404);
    abort_unless(in_array($format, ['pdf', 'excel'], true), 404);

    return view('admin.laporan.preview', [
        'document' => $document,
        'format' => $format,
    ]);
})->name('laporan.preview');
