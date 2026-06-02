<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LeaveRequestResource\Pages;
use App\Models\LeaveRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeaveRequestResource extends Resource
{
    protected static ?string $model = LeaveRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Manajemen HR';

    protected static ?string $navigationLabel = 'Cuti';

    protected static ?string $modelLabel = 'Pengajuan Cuti';

    protected static ?string $pluralModelLabel = 'Pengajuan Cuti';

    protected static ?string $slug = 'cuti';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        $pending = static::getModel()::where('status', 'Menunggu')->count();

        return $pending > 0 ? (string) $pending : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pengajuan')
                    ->schema([
                        Forms\Components\Select::make('employee_id')
                            ->label('Karyawan')
                            ->relationship('employee', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('leave_type')
                            ->label('Jenis Cuti')
                            ->options([
                                'Cuti Tahunan' => 'Cuti Tahunan',
                                'Cuti Sakit' => 'Cuti Sakit',
                                'Cuti Khusus' => 'Cuti Khusus',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->native(false)
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('duration_days')
                            ->label('Durasi (hari)')
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                        Forms\Components\DatePicker::make('requested_at')
                            ->label('Tanggal Pengajuan')
                            ->default(now())
                            ->native(false)
                            ->required(),
                        Forms\Components\Textarea::make('reason')
                            ->label('Alasan')
                            ->rows(4)
                            ->required()
                            ->columnSpan('full'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Approval')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'Menunggu' => 'Menunggu',
                                'Disetujui' => 'Disetujui',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->default('Menunggu')
                            ->required(),
                        Forms\Components\DateTimePicker::make('reviewed_at')
                            ->label('Diproses Pada')
                            ->native(false),
                        Forms\Components\Textarea::make('reviewer_note')
                            ->label('Catatan Reviewer')
                            ->rows(3)
                            ->columnSpan('full'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Karyawan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('employee.department')
                    ->label('Departemen')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('leave_type')
                    ->label('Jenis')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_days')
                    ->label('Durasi')
                    ->suffix(' hari')
                    ->sortable(),
                Tables\Columns\TextColumn::make('requested_at')
                    ->label('Diajukan')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu' => 'warning',
                        'Disetujui' => 'success',
                        'Ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Menunggu' => 'Menunggu',
                        'Disetujui' => 'Disetujui',
                        'Ditolak' => 'Ditolak',
                    ]),
                Tables\Filters\SelectFilter::make('leave_type')
                    ->label('Jenis Cuti')
                    ->options([
                        'Cuti Tahunan' => 'Cuti Tahunan',
                        'Cuti Sakit' => 'Cuti Sakit',
                        'Cuti Khusus' => 'Cuti Khusus',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (LeaveRequest $record): bool => $record->status === 'Menunggu')
                    ->action(function (LeaveRequest $record): void {
                        $record->update([
                            'status' => 'Disetujui',
                            'reviewed_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Pengajuan cuti disetujui')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-m-x-mark')
                    ->color('danger')
                    ->visible(fn (LeaveRequest $record): bool => $record->status === 'Menunggu')
                    ->form([
                        Forms\Components\Textarea::make('reviewer_note')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (LeaveRequest $record, array $data): void {
                        $record->update([
                            'status' => 'Ditolak',
                            'reviewed_at' => now(),
                            'reviewer_note' => $data['reviewer_note'],
                        ]);

                        Notification::make()
                            ->title('Pengajuan cuti ditolak')
                            ->danger()
                            ->send();
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('requested_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaveRequests::route('/'),
            'create' => Pages\CreateLeaveRequest::route('/create'),
            'edit' => Pages\EditLeaveRequest::route('/{record}/edit'),
        ];
    }
}
