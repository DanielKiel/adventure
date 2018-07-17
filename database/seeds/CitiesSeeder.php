<?php

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\City::create([
            'apiId' => 2882360,
            'name' => 'Kürbitz',
            'country' => 'DE',
            'lon' => 12.06667,
            'lat' => 50.466671
        ]);
    }
}
