<?php

namespace App\Filament\Resources\DocumentSignatureLogs;

use App\Filament\Resources\DocumentSignatureLogs\Pages\ListDocumentSignatureLogs;
use App\Filament\Resources\DocumentSignatureLogs\Schemas\DocumentSignatureLogForm;
use App\Filament\Resources\DocumentSignatureLogs\Tables\DocumentSignatureLogsTable;
use App\Models\DocumentSignatureLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DocumentSignatureLogResource extends Resource
{
    protected static ?string $model = DocumentSignatureLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'action';

    protected static ?int $navigationSort = 5;

    protected static ?string $pluralModelLabel = 'Log Tanda Tangan';

    public static function getNavigationGroup(): ?string
    {
        return 'Tanda Tangan';
    }

    public static function form(Schema $schema): Schema
    {
        return DocumentSignatureLogForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocumentSignatureLogsTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        if (! Auth::check()) {
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $query = parent::getEloquentQuery();

        if ($user->hasRole('super_admin')) {
            return $query->latest();
        }

        return $query->where('user_id', $user->id)->latest();
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
            'index' => ListDocumentSignatureLogs::route('/'),
        ];
    }
}
