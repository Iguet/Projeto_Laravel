<?php

namespace App\Listeners;

use App\Events\NotificationReadEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LerDemandaNotificationListener
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
    public function handle(NotificationReadEvent $event)
    {

        dd($event->user->readNotifications);

    }
}
