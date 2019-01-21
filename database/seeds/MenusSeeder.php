<?php

use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	App\Model\Menu::create([
        	'name' => 'Home',
        	'link' => '/',
        	'parent_id' => 0
        ]);

        $modelProducts = App\Model\Menu::create([
        	'name' => 'Products',
        	'link' => '/shop',
        	'parent_id' => 0
        ]);

        App\Model\Menu::create([
        	'name' => 'Phones',
        	'link' => '/shop/phones',
        	'parent_id' => $modelProducts->id
        ]);

        App\Model\Menu::create([
        	'name' => 'Computers',
        	'link' => '/shop/computers',
        	'parent_id' => $modelProducts->id
        ]);

        App\Model\Menu::create([
        	'name' => 'News',
        	'link' => '/news',
        	'parent_id' => 0
        ]);

        App\Model\Menu::create([
        	'name' => 'About',
        	'link' => '/about',
        	'parent_id' => 0
        ]);

        App\Model\Menu::create([
        	'name' => 'Contacts',
        	'link' => '/contacts',
        	'parent_id' => 0
        ]);
    }
}
