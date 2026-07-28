<?php

namespace App\Filament\Resources\DocumentVersions\Tables;

use App\Filament\Exports\DocumentVersionExporter;
use App\Models\DocumentVersion;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DocumentVersionsTable
{
    public static function configure(Table $table): Table
    {
        $user = Auth::user();
        $isSuperAdmin = $user && $user->hasRole('super_admin');

        $table = $table
            ->columns([
                TextColumn::make('document.title')
                    ->label('Record Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('version_number')
                    ->label('Version')
                    ->badge()
                    ->sortable(),

                TextColumn::make('original_filename')
                    ->label('Document File')
                    ->searchable()
                    ->icon('heroicon-o-document')
                    ->url(fn (DocumentVersion $record): string => route('documents.preview', [
                        'document' => $record->document_id,
                        'version' => $record->version_number,
                    ]))
                    ->openUrlInNewTab(),

                TextColumn::make('document.uploader.name')
                    ->label('Uploader')
                    ->badge()->color('success')
                    ->searchable()
                    ->sortable()
                    ->visible(fn () => $user->hasAnyRole(['super_admin', 'admin', 'recipient'])),

                TextColumn::make('document.recipients.name')
                    ->label('Recipients')
                    ->badge()->color('warning')
                    ->searchable()
                    ->visible(fn () => $user->hasAnyRole(['super_admin', 'admin', 'uploader']))
                    ->wrap(),
                TextColumn::make('created_at')
                    ->label('Uploaded At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Eksport Versi Dokumen')
                    ->exporter(DocumentVersionExporter::class)
                    ->visible($isSuperAdmin),
            ])
            ->recordActions([
                // We typically just want to view or download from here
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->label('Ekspor Pilihan ke Excel')
                        ->exporter(DocumentVersionExporter::class)
                        ->visible($isSuperAdmin),
                ]),
            ])
            ->defaultSort('created_at', 'asc');

        return $table;
    }
}
