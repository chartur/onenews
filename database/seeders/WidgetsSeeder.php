<?php

namespace Database\Seeders;

use App\Models\Widget;
use Illuminate\Database\Seeder;

class WidgetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $styles = [
            [
                'name' => 'Փոքր փոստեր',
                'type' => 'posts',
                'description' => 'Փոքր փոստերը ունենում են ուղղանկյունաձև նկար՝ ձախ մասում։ 
                 Փոստի վերնագիրը գտնվում է նկարից աջ և ընդգրկում է նկարի աջ մասը և երկար 
                 լինելու դեպքում շարունակում է նկարի ներքևի մասից։ Ամսաթիվը և դիտումների քանակը կշարունակի վերնագրին։',
                'file_url' => 'components.widgets.small-category-content-loader',
                'admin_file_url' => 'admin.components.widgets.posts-widget'
            ],
            [
                'name' => 'Միջին փոստեր (Հորիզոնական)',
                'type' => 'posts',
                'description' => 'Միջին փոստերը ունենում են ուղղանկյունաձև կամ քառակուսի նկար՝ ձախ մասում։ 
                 Փոստի վերնագիրը գտնվում է նկարից աջ։ Տպվում է նաև նյութից մի փոքր հատված։ Ամսաթիվը և դիտումների քանակը ներքևից։',
                'file_url' => 'components.widgets.middle-category-text-right-content-loader',
                'admin_file_url' => 'admin.components.widgets.posts-widget'
            ],
            [
                'name' => 'Միջին փոստեր (Ուղղահայաց)',
                'type' => 'posts',
                'description' => 'Միջին փոստերը ունենում են ուղղանկյունաձև կամ քառակուսի նկար՝ վերևի մասում։ 
                 Փոստի վերնագիրը գտնվում է նկարից ներքև և ընդգրկում է 3 տող և երկար 
                 լինելու դեպքում շարունակության փոխարեն "..." է դրվում։ Ամսաթիվը և դիտումների քանակը վերնագրի ներքևից։',
                'file_url' => 'components.widgets.middle-category-text-bottom-content-loader',
                'admin_file_url' => 'admin.components.widgets.posts-widget'
            ],
            [
                'name' => 'Բաժանորդագրվել',
                'type' => 'subscription',
                'description' => 'Դաշտ բաժանորդագրվելու համար։',
                'file_url' => 'components.widgets.subscription-form',
                'admin_file_url' => 'admin.components.widgets.subscription-widget'
            ],
            [
                'name' => 'HTML',
                'type' => 'html',
                'description' => 'Դաշտը նախատեսված է տեղադրել պատրաստի կոդեր որոնք կբացազատվեն որպես կոմպոնենտ։',
                'file_url' => 'components.widgets.html',
                'admin_file_url' => 'admin.components.widgets.html-widget'
            ],
        ];

        Widget::insert($styles);
    }
}
