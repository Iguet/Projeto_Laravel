<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use App\Events\NotificationReadEvent;
use App\Notifications\NovaDemanda;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NovaDemandaNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NotificationReadEvent $event
     * @return void
     * @throws \Exception
     */
    public function handle(NotificationEvent $event)
    {

        $user = User::find($event->user);

        $notification = new NovaDemanda();

        $user->notify($notification);

    }
}
