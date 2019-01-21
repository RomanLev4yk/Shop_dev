<?php

use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\Payment::create([
        	'name' => 'Visa',
        	'description' => 'text',
        	'link' => 'http://visa.com'
        ]);

        App\Model\Payment::create([
        	'name' => 'paypal',
        	'description' => 'text',
        	'link' => 'http://paypal.com'
        ]);

        App\Model\Payment::create([
        	'name' => 'mastercard',
        	'description' => 'text',
        	'link' => 'http://mastercard.com'
        ]);

        App\Model\Payment::create([
        	'name' => 'express',
        	'description' => 'text',
        	'link' => 'http://express.com'
        ]);

        App\Model\Payment::create([
        	'name' => 'discover',
        	'description' => 'text',
        	'link' => 'http://discover.com'
        ]);
    }
}
