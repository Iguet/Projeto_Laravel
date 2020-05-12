<?php

namespace App\Providers\App\Listeners;

use App\Providers\NotificationReadEvent;
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
     * @param  NotificationReadEvent  $event
     * @return void
     */
    public function handle(NotificationReadEvent $event)
    {
        //
    }
}
