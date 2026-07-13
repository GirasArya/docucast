<?php

namespace App\Filament\Resources\DrawSignatures\Pages;

use App\Filament\Resources\DrawSignatures\DrawSignatureResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDrawSignature extends EditRecord
{
    protected static string $resource = DrawSignatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
