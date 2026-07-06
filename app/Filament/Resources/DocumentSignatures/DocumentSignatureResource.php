<?php

namespace App\Filament\Resources\DocumentSignatures;

use App\Filament\Resources\Documents\Schemas\ListDocumentSignatures as SchemasListDocumentSignatures;
use App\Filament\Resources\DocumentSignatures\Pages\CreateDocumentSignature;
use App\Filament\Resources\DocumentSignatures\Pages\CreateOwnDocumentSignature;
use App\Filament\Resources\DocumentSignatures\Pages\EditDocumentSignature;
use App\Filament\Resources\DocumentSignatures\Pages\ListDocumentSignatures;
use App\Filament\Resources\DocumentSignatures\Schemas\DocumentSignatureForm;
use App\Filament\Resources\DocumentSignatures\Tables\DocumentSignaturesTable;
use App\Models\DocumentSignature;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DocumentSignatureResource extends Resource
{
    protected static ?string $model = DocumentSignature::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencil;

    protected static ?string $recordTitleAttribute = 'DocumentSignature';

    protected static ?int $navigationSort = 4;

    protected static ?string $pluralModelLabel = 'Tanda Tangan mandiri ';

    public static function getNavigationGroup(): ?string
    {
        return 'Tanda Tangan';
    }

    public static function form(Schema $schema): Schema
    {
        return DocumentSignatureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocumentSignaturesTable::configure($table);
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
            'index' => CreateOwnDocumentSignature::route('/'),
        ];
    }
}
