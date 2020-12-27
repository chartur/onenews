<?php

    $seo = \App\Models\Seo::where('slug', 'main')
        ->first();

return [
    'breaking_news' => 'ПОСЛЕДНИЕ НОВОСТИ',
    'menu' => [
        'home' => ['name' => 'Главная', 'link' => '/', 'desc' => $seo->ru_title],
        'category' => ['name' => 'Категории', 'link' => '/categories', 'desc' => 'Категории '.$seo->ru_title],
        'about' => ['name' => 'О Нас', 'link' => '/about', 'desc' => 'О Нас '.$seo->ru_title],
        'contact' => ['name' => 'Свяжитесь с нами', 'link' => '/contact', 'desc' => 'Свяжитесь с нами '.$seo->ru_title],
        'video' => ['name' => 'Видеоролики', 'link' => '/videos', 'desc' => 'Видеоролики '.$seo->ru_title]
    ],
    'newsletter' => [
        'title' => 'Новостная рассылка',
        'name' => 'Имя',
        'email' => 'Эл. адрес',
        'subscribe' => 'Подписываться'
    ],
    'categories' => 'Категории',
    'popular_tags' => 'Популярные теги',
    'you_are_here' => 'Вы здесь:',

    'contact_form' => [
        'name' => 'Имя',
        'email' => 'Эл. адрес',
        'message' => 'Письмо',
        'send' => 'Послать',
    ],

    'return_home' => 'Назад',
    'search' => 'Поиск',
    'href' => 'Источник:՝',
    'telegram-popup-content' => '<b>Присоединяйтесь к нам в Telegram</b><span>Гарантируем быструю и достоверную информацию</span>',
    'close' => 'Закрыть',
    'message_sent' => 'Письмо было успешно отправлено. Мы ответим вам в ближайшее время. Если вы не получили письмо от нашего сайта, проверьте раздел СПАМ'
];