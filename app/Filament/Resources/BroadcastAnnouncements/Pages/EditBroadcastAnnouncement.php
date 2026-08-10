<?php

namespace App\Filament\Resources\BroadcastAnnouncements\Pages;

use App\Filament\Resources\BroadcastAnnouncements\BroadcastAnnouncementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBroadcastAnnouncement extends EditRecord
{
    protected static string $resource = BroadcastAnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
