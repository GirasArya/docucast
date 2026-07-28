<?php

namespace App\Filament\Resources\BroadcastAnnouncements\Pages;

use App\Filament\Resources\BroadcastAnnouncements\BroadcastAnnouncementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBroadcastAnnouncements extends ListRecords
{
    protected static string $resource = BroadcastAnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat Broadcast Baru'),
        ];
    }
}
