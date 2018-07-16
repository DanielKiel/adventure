<?php

namespace App\Console\Commands\Imports;

use App\City;
use App\Weather;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Cities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a simple import command for downloaded cities by openweathermap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '8G');

        $this->info('importing from downloaded cities file by https://openweathermap.org');

        $json = json_decode( file_get_contents( storage_path('imports/city.list.min.json') ) );

        $insert = [];
        $now = Carbon::now();

        foreach ($json as $city) {

            array_push($insert, [
                'apiId' => $city->id,
                'name' => $city->name,
                'country' => $city->country,
                'lon' => $city->coord->lon,
                'lat' => $city->coord->lat,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            if (count($insert) === 100) {
                $this->info('inserting 100 cities');
                City::insert($insert);
                $insert = [];
            }

        }

        if (! empty($insert)) {
            $this->info('inserting ' . count($insert) . ' cities');
            City::insert($insert);
        }

        $this->info('inserted ' . count($json) . ' cities');
    }
}
