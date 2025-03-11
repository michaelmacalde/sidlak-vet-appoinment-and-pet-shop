<?php

namespace App\Observers;

use App\Filament\Resources\AnnouncementResource;
use App\Models\Announcement;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class AnnouncementObserver
{
    /**
     * Handle the Announcement "created" event.
     */
    public function created(Announcement $announcement): void
    {
        // Ensure the Announcement model has a `user` relationship
        if ($announcement->user && $announcement->user->hasRole('super_admin')) {
            $this->notifyVolunteers($announcement);
        }
    }

    /**
     * Handle the Announcement "updated" event.
     */
    public function updated(Announcement $announcement): void
    {
        //
    }

    /**
     * Handle the Announcement "deleted" event.
     */
    public function deleted(Announcement $announcement): void
    {
        //
    }

    /**
     * Handle the Announcement "restored" event.
     */
    public function restored(Announcement $announcement): void
    {
        //
    }

    /**
     * Handle the Announcement "force deleted" event.
     */
    public function forceDeleted(Announcement $announcement): void
    {
        //
    }

    /**
     * Create a Notification instance.
     */
    private function createNotification(string $title, string $body, Announcement $announcement): Notification
    {
        return Notification::make()
            ->title($title)
            ->icon('heroicon-o-archive-box')
            ->body($body)
            ->actions([
                Action::make('View')
                    ->button()
                    ->icon('heroicon-o-eye')
                    ->label('View')
                    ->url(AnnouncementResource::getUrl('edit', ['record' => $announcement])),
            ]);
    }

    /**
     * Notify all volunteers about the new announcement.
     */
    private function notifyVolunteers(Announcement $announcement): void
    {
        // Get all users with the 'volunteer' role
        $volunteers = User::role('volunteer')->get();

        foreach ($volunteers as $volunteer) {
            $notification = $this->createNotification(
                'New Announcement',
                "A new announcement has been created by {$announcement->user->name}.",
                $announcement
            );

            // Send notification to each volunteer
            $notification->sendToDatabase($volunteer);
        }
    }
}
