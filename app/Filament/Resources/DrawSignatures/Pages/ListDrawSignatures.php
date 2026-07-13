<?php

namespace App\Filament\Resources\DrawSignatures\Pages;

use App\Filament\Resources\DrawSignatures\DrawSignatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDrawSignatures extends ListRecords
{
    protected static string $resource = DrawSignatureResource::class;

    public function getBreadcrumbs(): array
    {
        return [
            filament()->getUrl() => 'Dashboard',
            DrawSignatureResource::getUrl('index') => 'Tanda Tangan',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
