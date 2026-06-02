<?php

namespace App\Filament\Admin\Resources\PayrollRecordResource\Pages;

use App\Filament\Admin\Resources\PayrollRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPayrollRecord extends EditRecord
{
    protected static string $resource = PayrollRecordResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
