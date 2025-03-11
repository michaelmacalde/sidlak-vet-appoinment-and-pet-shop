<?php

namespace App\Livewire\Pages;

use App\Models\Announcement;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AnnouncementSinglePage extends Component
{
    public $announcement;

    public function mount($announcementId)
    {
        $this->announcement = Announcement::with(['category','blogPost'])->findOrFail($announcementId);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.announcement-single-page',[
            'announcement' => $this->announcement
        ]);
    }
}
