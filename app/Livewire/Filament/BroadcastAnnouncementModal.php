<?php

namespace App\Livewire\Filament;

use App\Models\BroadcastAnnouncement;
use App\Models\BroadcastUserRead;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BroadcastAnnouncementModal extends Component
{
    public bool $showModal = false;

    public ?int $announcementId = null;

    public string $title = '';

    public string $type = 'update';

    public string $content = '';

    public ?string $createdAt = null;

    public int $remainingCount = 0;

    public function mount(): void
    {
        $this->loadUnreadBroadcast();
    }

    public function loadUnreadBroadcast(): void
    {
        $user = Auth::user();

        if (! $user) {
            $this->showModal = false;

            return;
        }

        // Query active announcements that the user has not read yet
        $unreadQuery = BroadcastAnnouncement::query()
            ->where('is_active', true)
            ->whereDoesntHave('reads', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->latest();

        $unreadCount = $unreadQuery->count();
        $this->remainingCount = max(0, $unreadCount - 1);

        $announcement = $unreadQuery->first();

        if ($announcement) {
            $this->announcementId = $announcement->id;
            $this->title = $announcement->title;
            $this->type = $announcement->type;
            $this->content = $announcement->content;
            $this->createdAt = $announcement->created_at?->format('d M Y');
            $this->showModal = true;
        } else {
            $this->showModal = false;
        }
    }

    public function acknowledge(int $id): void
    {
        $user = Auth::user();

        if ($user && $id) {
            BroadcastUserRead::firstOrCreate(
                [
                    'announcement_id' => $id,
                    'user_id' => $user->id,
                ],
                [
                    'read_at' => now(),
                ]
            );
        }

        // Load next unread announcement if any
        $this->loadUnreadBroadcast();
    }

    public function render(): View
    {
        return view('livewire.filament.broadcast-announcement-modal');
    }
}
