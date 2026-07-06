<?php

namespace App\Filament\Resources\DocumentSignatures\Pages;

use App\Filament\Resources\DocumentSignatures\DocumentSignatureResource;
use Filament\Resources\Pages\Page;

class CreateOwnDocumentSignature extends Page
{
    protected static string $resource = DocumentSignatureResource::class;

    protected string $view = 'filament.resources.document-signatures.pages.create-own-document-signature';

    protected static ?string $title = 'Tanda Tangan Mandiri';

    public function getBreadcrumbs(): array
    {
        return [
            filament()->getUrl() => 'Dashboard',
            DocumentSignatureResource::getUrl('index') => 'Mandiri',
        ];
    }
}
