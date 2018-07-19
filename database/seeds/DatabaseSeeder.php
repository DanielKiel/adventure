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
        $this->call(CitiesSeeder::class);

        \App\User::create([
            'name' => 'Daniel Koch',
            'email' => 'dk.projects.manager@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('nietzsche'),
        ]);
    }
}
