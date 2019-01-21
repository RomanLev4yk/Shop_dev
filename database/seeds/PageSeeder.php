<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\Page::create([
          'url' => '/',
          'title' => 'Home page',
          'description' => 'Some text',
          'content' => 'Content',
          'view' => 'content.index'
        ]);

        App\Model\Page::create([
          'url' => 'shop',
          'title' => 'Shop page',
          'description' => 'Shop page description',
          'content' => 'Shop page content',
          'view' => 'content.shop'
        ]);

        App\Model\Page::create([
          'url' => 'shop/product1',
          'title' => 'Product 1',
          'description' => 'Product 1 description',
          'content' => 'Product 1 content',
          'view' => 'content.product'
        ]);

        App\Model\Page::create([
          'url' => 'shop/product',
          'title' => 'Product 2',
          'description' => 'Product 2 description',
          'content' => 'Product 2 content',
          'view' => 'content.product'
        ]);

        App\Model\Page::create([
          'url' => 'shop/product3',
          'title' => 'Product 3',
          'description' => 'Product 3 description',
          'content' => 'Product 3 content',
          'view' => 'content.product'
        ]);

        App\Model\Page::create([
          'url' => 'cart',
          'title' => 'Cart',
          'description' => 'Cart description',
          'content' => 'Cart content',
          'view' => 'content.cart'
        ]);

        App\Model\Page::create([
          'url' => 'checkout',
          'title' => 'Checkout',
          'description' => 'Checkout description',
          'content' => 'Checkout content',
          'view' => 'content.checkout'
        ]);

        App\Model\Page::create([
          'url' => 'status',
          'title' => 'Status',
          'description' => 'Status description',
          'content' => 'Status content',
          'view' => 'content.status'
        ]);

        App\Model\Page::create([
          'url' => 'profile',
          'title' => 'Profile',
          'description' => 'Profile description',
          'content' => 'Profile content',
          'view' => 'content.profile'
        ]);


    }
}
