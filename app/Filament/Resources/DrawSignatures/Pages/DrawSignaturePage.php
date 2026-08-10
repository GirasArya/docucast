<?php

namespace App\Filament\Resources\DrawSignatures\Pages;

use App\Filament\Resources\DrawSignatures\DrawSignatureResource;
use App\Models\DrawSignature;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Storage;

class DrawSignaturePage extends Page
{
    protected static string $resource = DrawSignatureResource::class;

    protected string $view = 'filament.resources.draw-signatures.pages.draw-signature-page';

    protected static ?string $title = 'Buat Tanda Tangan';

    public function getBreadcrumbs(): array
    {
        return [
            filament()->getUrl() => 'Dashboard',
            DrawSignatureResource::getUrl('index') => 'Tanda Tangan',
        ];
    }

    public function getSignaturesProperty()
    {
        return DrawSignature::where('user_id', auth()->id())
            ->latest()
            ->get();
    }

    public function saveSignature(string $base64Data, string $fileName): void
    {
        try {
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
                $base64Data = substr($base64Data, strpos($base64Data, ',') + 1);
                $type = strtolower($type[1]);

                if ($type !== 'png') {
                    throw new \Exception('Hanya format PNG yang diperbolehkan.');
                }
            } else {
                throw new \Exception('Data gambar tidak valid.');
            }

            $decodedData = base64_decode($base64Data);
            if ($decodedData === false) {
                throw new \Exception('Dekode data gambar gagal.');
            }

            if (strlen($decodedData) > 200 * 1024) {
                throw new \Exception('Ukuran file tanda tangan melebihi batas maksimum 200 KB.');
            }

            // Generate clean filename
            $safeName = time().'_'.preg_replace('/[^a-zA-Z0-9_\-\.]/', '', $fileName);
            if (! str_ends_with($safeName, '.png')) {
                $safeName .= '.png';
            }

            // Ensure directory exists
            if (! Storage::disk('public')->exists('signatures')) {
                Storage::disk('public')->makeDirectory('signatures');
            }

            $path = 'signatures/'.$safeName;
            Storage::disk('public')->put($path, $decodedData);

            DrawSignature::create([
                'user_id' => auth()->id(),
                'file_path' => $path,
                'file_name' => $safeName,
            ]);

            Notification::make()
                ->title('Tanda tangan berhasil disimpan')
                ->success()
                ->send();

            $this->dispatch('signature-saved');

        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal menyimpan tanda tangan')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function deleteSignature(int $id): void
    {
        try {
            $sig = DrawSignature::where('user_id', auth()->id())->findOrFail($id);

            // Delete file
            if (Storage::disk('public')->exists($sig->file_path)) {
                Storage::disk('public')->delete($sig->file_path);
            }

            $sig->delete();

            Notification::make()
                ->title('Tanda tangan berhasil dihapus')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal menghapus tanda tangan')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
