<?php

namespace App\Filament\Resources\BroadcastAnnouncements\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BroadcastAnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Pengumuman')
                    ->placeholder('Contoh: DocuCast Version 2.0 Maintenance Update')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Select::make('type')
                    ->label('Tipe Broadcast')
                    ->options([
                        'update' => 'Sistem Update / Pembaruan',
                        'info' => 'Informasi',
                        'warning' => 'Peringatan / Maintenance',
                        'success' => 'Fitur Baru / Rilis',
                    ])
                    ->required()
                    ->default('update'),

                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->helperText('Jika aktif, pengumuman akan ditampilkan 1 kali ke setiap user setelah login.')
                    ->default(true),

                RichEditor::make('content')
                    ->label('Isi Pesan Pengumuman')
                    ->placeholder('Tulis isi pesan pengumuman atau pembaruan sistem di sini...')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
