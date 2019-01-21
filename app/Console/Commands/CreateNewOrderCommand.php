<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\CreateNewOrderEvent;
use App\Mail\NewOrder;
use App\Model\Order;
use App\Model\OrderStatus;

class CreateNewOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test event';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      

        $order->event(new CreateNewOrderEvent($status, $order));
    }
}
