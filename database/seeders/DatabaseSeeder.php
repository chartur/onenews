<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->insertData();

        // $this->call([
        //     // CategoriesSeeder::class,
        //     // WidgetsSeeder::class,
        //     // TagsSeeder::class,
        //     // UsersSeeder::class,
        //     // OptionsSeeder::class,
        //     // AdsSeeder::class
        // ]);
    }

    private function insertData()
    {
        $path = 'database/data/data.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('All data of server seeded!');
    }
}
