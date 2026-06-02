<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PayrollRecordResource\Pages;
use App\Models\PayrollRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PayrollRecordResource extends Resource
{
    protected static ?string $model = PayrollRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Penggajian';

    protected static ?string $navigationLabel = 'Penggajian';

    protected static ?string $modelLabel = 'Data Gaji';

    protected static ?string $pluralModelLabel = 'Data Gaji';

    protected static ?string $slug = 'penggajian';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pegawai dan Periode')
                    ->schema([
                        Forms\Components\Select::make('employee_id')
                            ->label('Karyawan')
                            ->relationship('employee', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('period')
                            ->label('Periode')
                            ->placeholder('Mei 2026')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\Select::make('status')
                            ->options([
                                'Draft' => 'Draft',
                                'Siap Dibayar' => 'Siap Dibayar',
                                'Dibayar' => 'Dibayar',
                            ])
                            ->default('Draft')
                            ->required(),
                        Forms\Components\DatePicker::make('paid_at')
                            ->label('Tanggal Bayar')
                            ->native(false),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Komponen Gaji')
                    ->schema([
                        Forms\Components\TextInput::make('base_salary')
                            ->label('Gaji Pokok')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),
                        Forms\Components\TextInput::make('allowance')
                            ->label('Tunjangan')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),
                        Forms\Components\TextInput::make('attendance_deduction')
                            ->label('Potongan Kehadiran')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Karyawan')
                    ->description(fn (PayrollRecord $record): string => $record->employee?->position . ' - ' . $record->employee?->department)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('period')
                    ->label('Periode')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('base_salary')
                    ->label('Gaji Pokok')
                    ->formatStateUsing(fn ($state): string => self::rupiah($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('allowance')
                    ->label('Tunjangan')
                    ->formatStateUsing(fn ($state): string => self::rupiah($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('attendance_deduction')
                    ->label('Potongan')
                    ->formatStateUsing(fn ($state): string => self::rupiah($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('net_salary')
                    ->label('Gaji Bersih')
                    ->formatStateUsing(fn ($state): string => self::rupiah($state))
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Dibayar' => 'success',
                        'Siap Dibayar' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('period')
                    ->label('Periode')
                    ->options(fn (): array => PayrollRecord::query()
                        ->select('period')
                        ->distinct()
                        ->orderBy('period')
                        ->pluck('period', 'period')
                        ->all()),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Draft' => 'Draft',
                        'Siap Dibayar' => 'Siap Dibayar',
                        'Dibayar' => 'Dibayar',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Slip'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('period', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayrollRecords::route('/'),
            'create' => Pages\CreatePayrollRecord::route('/create'),
            'view' => Pages\ViewPayrollRecord::route('/{record}'),
            'edit' => Pages\EditPayrollRecord::route('/{record}/edit'),
        ];
    }

    public static function rupiah(mixed $amount): string
    {
        return 'Rp ' . number_format((float) $amount, 0, ',', '.');
    }
}
