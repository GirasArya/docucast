<?php

namespace App\Filament\Resources\DocumentSignatureLogs\Pages;

use App\Filament\Resources\DocumentSignatureLogs\DocumentSignatureLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDocumentSignatureLogs extends ListRecords
{
    protected static string $resource = DocumentSignatureLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Read-only audit log
        ];
    }
}
