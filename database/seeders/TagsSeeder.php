<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['hy_name' => 'Արցախ', 'ru_name' => 'Арцах'],
            ['hy_name' => 'Նիկոլ Փաշինյան', 'ru_name' => 'Никол Пашинян'],
            ['hy_name' => 'Պատերազմ', 'ru_name' => 'Вайна'],
            ['hy_name' => 'Ավտովթար', 'ru_name' => 'Авария'],
        ];

        Tag::insert($tags);
    }
}
