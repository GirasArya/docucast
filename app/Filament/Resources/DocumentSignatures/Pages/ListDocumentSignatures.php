<?php

namespace App\Filament\Resources\DocumentSignatures\Pages;

use App\Filament\Resources\DocumentSignatures\DocumentSignatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDocumentSignatures extends ListRecords
{
    protected static string $resource = DocumentSignatureResource::class;

    public function getBreadcrumbs(): array
    {
        return [
            filament()->getUrl() => 'Dashboard',
            DocumentSignatureResource::getUrl('index') => 'Mandiri',
        ];
    }

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         CreateAction::make()->label('Buat Tanda Tangan'),
    //     ];
    // }

}
