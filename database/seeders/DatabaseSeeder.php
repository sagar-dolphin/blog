<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'sagar',
            'email' => 'sagar@gmail.com',
            'password' => Hash::make('sagar@123')
        ]);

        User::create([
            'name' => 'parth',
            'email' => 'parth@gmail.com',
            'password' => Hash::make('parth@123')
        ]);
    }
}
