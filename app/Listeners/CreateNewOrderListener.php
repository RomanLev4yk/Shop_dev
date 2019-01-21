<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

use App\Events\CreateNewOrderEvent;
use App\Mail\NewOrder;

class CreateNewOrderListener
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


    public function subscribe(Dispatcher $events)
    {
      $events->listen(
        CreateNewOrderListener::class
      );
    }


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreateNewOrderEvent $event)
    {
      Mail::to($event->order->currentDelivery->user_email)
      ->send(new NewOrder($event->order, $event->status));
    }
}
