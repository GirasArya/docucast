<?php

namespace App\Filament\Resources\BroadcastAnnouncements\Pages;

use App\Filament\Resources\BroadcastAnnouncements\BroadcastAnnouncementResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateBroadcastAnnouncement extends CreateRecord
{
    protected static string $resource = BroadcastAnnouncementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();

        return $data;
    }
}
