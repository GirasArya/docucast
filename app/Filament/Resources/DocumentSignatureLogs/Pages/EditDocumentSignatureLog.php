<?php

namespace App\Filament\Resources\DocumentSignatureLogs\Pages;

use App\Filament\Resources\DocumentSignatureLogs\DocumentSignatureLogResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditDocumentSignatureLog extends EditRecord
{
    protected static string $resource = DocumentSignatureLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
