<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\ChirpCreated;
use App\Models\User;
use App\Notifications\NewChirp;

class SendChirpCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChirpCreated $event): void
    {
        foreach ($event->chirp->user->followers->cursor() as $user) {
            $user->notify(new NewChirp($event->chirp));
        }
    }
}
