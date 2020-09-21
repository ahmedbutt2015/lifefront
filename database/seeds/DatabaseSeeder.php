<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run () {
        User::create([
            'username' => "Test",
            'email'    => "user@life.com",
            'password' => Hash::make("123"),
        ]);

        \App\Notification::addUpdate([
            'user_id' => 1,
            'message' => 'First Notification for testing',
        ]);

        \App\Character::addUpdate([
            'first_name' => 'A',
            'last_name'  => 'character',
            'language'   => 'english',
            'prefix'     => 'en',
            'code'       => '000001',
            'address'    => 'en000001',
            'gender'     => 'male',
            'skin_tone'  => 'light',
            'hair_style' => 'black',
            'body_type'  => 'medium',
            'age'        => 18,
            'status'     => 'live',
            'family_id'  => 0,
            'user_id'    => 1,
        ]);

        $this->addJobs();
    }

    public function addJobs () {
        DB::table('jobs')->insert([
            ['slug' => 'advertiser', 'title' => 'Advertiser'],
            ['slug' => 'farmer', 'title' => 'Farmer'],
        ]);
    }


}
