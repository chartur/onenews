<?php

    $seo = \App\Models\Seo::where('slug', 'main')
        ->first();

return [
    'breaking_news' => 'Լրահոս',
    'menu' => [
        'home' => ['name' => 'Գլխավոր', 'link' => '/', 'desc' => $seo->hy_title],
        'category' => ['name' => 'Կատեգորիաներ', 'link' => '/categories', 'desc' => 'Կատեգորիաներ '.$seo->hy_title],
        'about' => ['name' => 'Մեր Մասին', 'link' => '/about', 'desc' => 'Մեր Մասին '.$seo->hy_title],
        'contact' => ['name' => 'Հետադարձ Կապ', 'link' => '/contact', 'desc' => 'Հետադարձ Կապ '.$seo->hy_title],
        'video' => ['name' => 'Տեսանյութեր', 'link' => '/videos', 'desc' => 'Տեսանյութեր '.$seo->hy_title]
    ],
    'newsletter' => [
        'title' => 'Տեղեկագիր',
        'name' => 'Անուն',
        'email' => 'Էլ. հասցե',
        'subscribe' => 'Բաժանորդագրվել'
    ],
    'categories' => 'Կատեգորիաներ',
    'popular_tags' => 'Հայտնի տեգեր',
    'you_are_here' => 'Ձեր հասցեն',

    'contact_form' => [
        'name' => 'Անուն',
        'email' => 'Էլ. հասցե',
        'message' => 'Նամակ',
        'send' => 'Ուղարկել',
    ],

    'return_home' => 'Վերադառնալ',
    'search' => 'Փնտրել',
    'href' => 'Աղբյուր՝',
    'telegram-popup-content' => '<b>Միացեք Մեզ Telegram-ում</b><span>Մենք երաշխավորում ենք արագ և հավաստի ինֆորմացիայի տրամադրումը</span>',
    'close' => 'Փակել',
    'message_sent' => 'Նամակը հաջողությամբ ուղարկվել է։ Մենք շուտով կպատասխանենք Ձեզ։ Եթե չեք ստացել նամակ մեր կայքից խնդրում ենք ստուգեք ՍՊԱՄ (SPAM) բաժինը',
    'no_data' => 'Տվյալներ չեն գտնվել'
];