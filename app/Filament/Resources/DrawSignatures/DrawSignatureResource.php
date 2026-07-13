<?php

namespace App\Filament\Resources\DrawSignatures;

use App\Filament\Resources\DrawSignatures\Pages\CreateDrawSignature;
use App\Filament\Resources\DrawSignatures\Pages\DrawSignaturePage;
use App\Filament\Resources\DrawSignatures\Pages\EditDrawSignature;
use App\Filament\Resources\DrawSignatures\Pages\ListDrawSignatures;
use App\Filament\Resources\DrawSignatures\Schemas\DrawSignatureForm;
use App\Filament\Resources\DrawSignatures\Tables\DrawSignaturesTable;
use App\Models\DrawSignature;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DrawSignatureResource extends Resource
{
    protected static ?string $model = DrawSignature::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Signature';

    protected static ?int $navigationSort = 3;

    protected static ?string $pluralModelLabel = 'Buat Tanda Tangan';

    public static function getNavigationGroup(): ?string
    {
        return 'Tanda Tangan';
    }

    public static function form(Schema $schema): Schema
    {
        return DrawSignatureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DrawSignaturesTable::configure($table);
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
            // 'index' => ListDrawSignatures::route('/'),
            'index' => DrawSignaturePage::route('/'),
        ];
    }
}
