<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{

    private function getData() {
        $data = [
            [
                'name' => 'Ցուցադրել ֆեյսբուքյան էջի պատուհանը',
                'key' => 'show_fb_popup',
                'value' => 0,
            ],
            [
                'name' => 'Ցուցադրել լողացող լուր',
                'key' => 'show_floating_news',
                'value' => 0,
            ],
            [
                'name' => 'Ցուցադրել լողացող գովազդ',
                'key' => 'show_floating_ads',
                'value' => 0,
            ],
            [
                'name' => 'Ցուցադրել տելեգրամյան կանալի պատուհանը',
                'key' => 'show_tg_popup',
                'value' => 0,
            ],
        ];

        return $data;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getData();
        Option::insert($data);
    }
}
