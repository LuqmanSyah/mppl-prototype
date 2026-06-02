<?php

namespace App\Filament\Admin\Resources\PayrollRecordResource\Pages;

use App\Filament\Admin\Resources\PayrollRecordResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePayrollRecord extends CreateRecord
{
    protected static string $resource = PayrollRecordResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
