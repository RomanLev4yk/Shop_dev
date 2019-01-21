<?php

use Illuminate\Database\Seeder;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $status = App\Model\OrderStatus::create([
        'name' => 'New status',
        'description' => 'New status description',
        'color' => 'black',
        'event_name' => 'createNewOrderEvent'
      ]);

      App\Model\Setting::create([
        'name' => 'defaultOrderStatus',
        'description' => '-',
        'value' => $status->name
      ]);
    }
}
