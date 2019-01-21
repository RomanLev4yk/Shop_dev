<?php

use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\Currency::create([
        	'code' => 'RUR',
        	'name' => 'Russian currency'
        ]);

        App\Model\Currency::create([
        	'code' => 'UAH',
        	'name' => 'Ukraine currency'
        ]);

        App\Model\Currency::create([
        	'code' => 'USD',
        	'name' => 'USA currency'
        ]);
    }
}
