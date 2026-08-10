<?php

namespace App\Filament\Exports;

use App\Models\DocumentVersion;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DocumentVersionExporter extends Exporter
{
    protected static ?string $model = DocumentVersion::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('document.unique_code')
                ->label('Kode Dokumen'),
            ExportColumn::make('document.title')
                ->label('Judul Dokumen'),
            ExportColumn::make('version_number')
                ->label('Versi'),
            ExportColumn::make('original_filename')
                ->label('Nama File'),
            ExportColumn::make('document.uploader.name')
                ->label('Pengunggah (Uploader)'),
            ExportColumn::make('created_at')
                ->label('Tanggal Diunggah'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Ekspor versi dokumen selesai, '.number_format($export->successful_rows).' '.str('baris')->plural($export->successful_rows).' berhasil diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('baris')->plural($failedRowsCount).' gagal diekspor.';
        }

        return $body;
    }
}
