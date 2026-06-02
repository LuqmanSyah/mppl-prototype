<?php

namespace App\Filament\Admin\Resources\PayrollRecordResource\Pages;

use App\Filament\Admin\Resources\PayrollRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPayrollRecord extends ViewRecord
{
    protected static string $resource = PayrollRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
