<?php

namespace App\Filament\Admin\Resources\PayrollRecordResource\Pages;

use App\Filament\Admin\Resources\PayrollRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPayrollRecords extends ListRecords
{
    protected static string $resource = PayrollRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Data Gaji'),
        ];
    }
}
