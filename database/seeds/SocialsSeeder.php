<?php

use Illuminate\Database\Seeder;

class SocialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\Setting::create([
        	'name' => 'socials_icon_facebook',
        	'description' => 'socials_icon',
        	'value' => 'https://uk-ua.facebook.com/beetroot'
        ]);

        App\Model\Setting::create([
        	'name' => 'socials_icon_instagram',
        	'description' => 'socials_icon',
        	'value' => 'https://www.instagram.com/beetroot'
        ]);

        App\Model\Setting::create([
        	'name' => 'socials_icon_pinterest',
        	'description' => 'socials_icon',
        	'value' => 'https://www.pinterest.com'
        ]);

        App\Model\Setting::create([
        	'name' => 'socials_icon_snapchat',
        	'description' => 'socials_icon',
        	'value' => 'https://www.snapchat.com'
        ]);

        App\Model\Setting::create([
        	'name' => 'socials_icon_youtube',
        	'description' => 'socials_icon',
        	'value' => 'https://www.youtube.com'
        ]);
    }
}
