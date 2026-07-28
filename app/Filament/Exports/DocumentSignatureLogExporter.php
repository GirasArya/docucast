<?php

namespace App\Filament\Exports;

use App\Models\DocumentSignatureLog;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DocumentSignatureLogExporter extends Exporter
{
    protected static ?string $model = DocumentSignatureLog::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('user.name')
                ->label('Penandatangan'),
            ExportColumn::make('user.nik')
                ->label('NPK'),
            ExportColumn::make('action')
                ->label('Aksi Log'),
            ExportColumn::make('description')
                ->label('Deskripsi Aktivitas'),
            ExportColumn::make('ip_address')
                ->label('IP Address'),
            ExportColumn::make('user_agent')
                ->label('User Agent'),
            ExportColumn::make('created_at')
                ->label('Waktu Export'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Ekspor log tanda tangan selesai, ' . number_format($export->successful_rows) . ' ' . str('baris')->plural($export->successful_rows) . ' berhasil diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('baris')->plural($failedRowsCount) . ' gagal diekspor.';
        }

        return $body;
    }
}
