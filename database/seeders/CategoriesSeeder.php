<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'hy_name' => 'Քաղաքականություն',
                'ru_name' => 'Политика',
                'slug' => 'political',
            ],
            [
                'hy_name' => 'Շոու բիզնես',
                'ru_name' => 'Шоу-бизнес',
                'slug' => 'show-business',
            ],
            [
                'hy_name' => 'Սպորտ',
                'ru_name' => 'Спорт',
                'slug' => 'sport',
            ],
            [
                'hy_name' => 'Բժշկական',
                'ru_name' => 'Медицинский',
                'slug' => 'medical',
            ],
            [
                'hy_name' => 'Հետաքրքիր',
                'ru_name' => 'Интересно',
                'slug' => 'interesting',
            ],
            [
                'hy_name' => 'Միջազգային',
                'ru_name' => 'Международный',
                'slug' => 'international',
            ],
            [
                'hy_name' => 'Մշակույթ',
                'ru_name' => 'Культура',
                'slug' => 'culture',
            ],
            [
                'hy_name' => 'Խոհանոց',
                'ru_name' => 'Кухня',
                'slug' => 'kitchen',
            ],
            [
                'hy_name' => 'Բնություն',
                'ru_name' => 'Природа',
                'slug' => 'nature',
            ],
        ];

        Category::insert($categories);
    }
}
