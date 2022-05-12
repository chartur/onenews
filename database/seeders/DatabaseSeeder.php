<?php

namespace Database\Seeders;

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
        $this->call([
            CategoriesSeeder::class,
//            PostsSeeder::class,
            WidgetsSeeder::class,
            TagsSeeder::class,
            UsersSeeder::class,
            OptionsSeeder::class
        ]);
    }
}
