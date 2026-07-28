<?php

namespace App\Filament\Resources\BroadcastAnnouncements;

use App\Filament\Resources\BroadcastAnnouncements\Pages\CreateBroadcastAnnouncement;
use App\Filament\Resources\BroadcastAnnouncements\Pages\EditBroadcastAnnouncement;
use App\Filament\Resources\BroadcastAnnouncements\Pages\ListBroadcastAnnouncements;
use App\Filament\Resources\BroadcastAnnouncements\Schemas\BroadcastAnnouncementForm;
use App\Filament\Resources\BroadcastAnnouncements\Tables\BroadcastAnnouncementsTable;
use App\Models\BroadcastAnnouncement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BroadcastAnnouncementResource extends Resource
{
    protected static ?string $model = BroadcastAnnouncement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 10;

    protected static ?string $pluralModelLabel = 'Broadcast Pengumuman';

    public static function getNavigationGroup(): ?string
    {
        return 'Sistem';
    }

    public static function canViewAny(): bool
    {
        return Auth::check() && Auth::user()->hasRole('super_admin');
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function form(Schema $schema): Schema
    {
        return BroadcastAnnouncementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BroadcastAnnouncementsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBroadcastAnnouncements::route('/'),
            'create' => CreateBroadcastAnnouncement::route('/create'),
            'edit' => EditBroadcastAnnouncement::route('/{record}/edit'),
        ];
    }
}
