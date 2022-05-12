<?php

namespace Database\Seeders;

use App\Models\Adsense;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adsense::insert([
            [
                'slug' => env("ADS_SLUG_FOR_INNER_POST"),
                'name' => env("ADS_SLUG_FOR_INNER_POST"),
                'content' => ""
            ],
            [
                'slug' => env("ADS_SLUG_END_OF_POST"),
                'name' => env("ADS_SLUG_END_OF_POST"),
                'content' => ""
            ],
        ]);
    }
}
