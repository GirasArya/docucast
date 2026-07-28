<?php

namespace App\Filament\Resources\BroadcastAnnouncements\Tables;

use App\Models\BroadcastAnnouncement;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class BroadcastAnnouncementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Pengumuman')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'update' => 'info',
                        'warning' => 'warning',
                        'success' => 'success',
                        'info' => 'gray',
                        default => 'primary',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),

                TextColumn::make('reads_count')
                    ->label('Telah Dilihat')
                    ->counts('reads')
                    ->badge()
                    ->color('success')
                    ->suffix(' user'),

                TextColumn::make('createdBy.name')
                    ->label('Pembuat')
                    ->placeholder('Superadmin'),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
