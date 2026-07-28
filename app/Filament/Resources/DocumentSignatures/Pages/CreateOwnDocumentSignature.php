<?php

namespace App\Filament\Resources\DocumentSignatures\Pages;

use App\Filament\Resources\DocumentSignatures\DocumentSignatureResource;
use App\Models\DocumentSignatureLog;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

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

    public function logExport(?int $documentVersionId = null, ?string $filename = null): void
    {
        $user = Auth::user();

        if (! $user) {
            return;
        }

        $description = 'Mengekspor dokumen bertanda tangan';
        if ($filename) {
            $description .= ': '.$filename;
        }

        DocumentSignatureLog::create([
            'document_version_id' => $documentVersionId,
            'user_id' => $user->id,
            'action' => 'EXPORTED_SIGNED_DOCUMENT',
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
