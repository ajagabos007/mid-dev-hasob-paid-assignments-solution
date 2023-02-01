<?php

namespace App\Listeners;

use App\Events\BrokerCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BrokerCreatedListener
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
     * @param  \App\Events\BrokerCreated  $event
     * @return void
     */
    public function handle(BrokerCreated $event)
    {
        //
    }
}
