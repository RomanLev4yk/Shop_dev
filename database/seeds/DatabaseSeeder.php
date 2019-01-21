<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(OrderStatusesSeeder::class);
        // $this->call(SettingsSeeder::class);
        // $this->call(PageSeeder::class);
        // $this->call(SocialsSeeder::class);
        // $this->call(CurrenciesSeeder::class);
        // $this->call(PaymentsSeeder::class);
        // $this->call(MenusSeeder::class);

        $this->call(VariablesSeeder::class);
    }
}
