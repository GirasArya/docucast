<?php

namespace App\Filament\Resources\DocumentSignatureLogs\Tables;

use App\Filament\Exports\DocumentSignatureLogExporter;
use App\Models\DocumentSignatureLog;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DocumentSignatureLogsTable
{
    public static function configure(Table $table): Table
    {
        $user = Auth::user();
        $isSuperAdmin = $user && $user->hasRole('super_admin');

        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Penandatangan')
                    ->description(fn(DocumentSignatureLog $record): ?string => $record->user?->nik ? 'NPK: ' . $record->user->nik : null)
                    ->searchable()
                    ->visible($isSuperAdmin),

                TextColumn::make('action')
                    ->label('Aksi Log')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn(string $state): string => str_replace('_', ' ', $state))
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Deskripsi File / Aktivitas')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->icon('heroicon-o-globe-alt')
                    ->toggleable(),

                TextColumn::make('user_agent')
                    ->label('User Agent')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Waktu Export')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Filter User')
                    ->relationship('user', 'name')
                    ->visible($isSuperAdmin)
                    ->searchable(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Eksport Log')
                    ->exporter(DocumentSignatureLogExporter::class),
            ])
            ->recordActions([
                // Read-only log list
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->label('Ekspor Pilihan ke Excel')
                        ->exporter(DocumentSignatureLogExporter::class),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
