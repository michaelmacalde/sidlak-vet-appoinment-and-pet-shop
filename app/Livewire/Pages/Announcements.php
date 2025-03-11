<?php

namespace App\Livewire\Pages;

use App\Models\Announcement;
use Filament\Notifications\Notification;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Announcements extends Component
{
    public $announcements;
    public $unreadCount = 0;

    protected $listeners = ['announcementAdded' => 'refreshAnnouncements'];

    public function mount()
    {
        $this->loadAnnouncements();
    }

    public function loadAnnouncements()
    {
        $this->announcements = Announcement::latest()->get();
        $this->unreadCount = Announcement::where('is_announced', 0)->count();
    }

    public function refreshAnnouncements()
    {
        $this->loadAnnouncements();
    }

    public function markAsRead($announcementId)
    {
        $announcement = Announcement::find($announcementId);
        if ($announcement) {
            $announcement->update(['is_announced' => 1]);
            $this->refreshAnnouncements();
        }
    }
  
    #[Title('Create Application Form')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.announcements');
    }
}
