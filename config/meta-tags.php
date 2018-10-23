<?php

return [

    'model' => \Fomvasss\LaravelMetaTags\Models\MetaTag::class,

    'available' => [
        'title' => ['title' => 'Заголовок страницы', 'max' => 65, 'form_type' => 'string',],
        'description' => ['title' => 'Описание страницы', 'max' => 300, 'form_type' => 'text',],
        'keywords' => ['title' => 'Ключевые слова',],

//            'og_title' => ['title' => 'OG-title', 'type' => 'og'],
//            'og_description' => ['title' => 'OG-description', 'type' => 'og'],
//            'og_type' => ['title' => 'OG-type', 'type' => 'og'],
//            'og_image' => ['title' => 'OG-image', 'type' => 'og'],
//            'og_url' => ['title' => 'OG-url', 'type' => 'og'],
//            'og_audio' => ['title' => 'OG-audio', 'type' => 'og'],
//            'og_determiner' => ['title' => 'OG-determiner', 'type' => 'og'],
//            'og_locale' => ['title' => 'OG-locale', 'type' => 'og'],
//            'og_site_name' => ['title' => 'OG-site_name', 'default' => '[site:name]', 'type' => 'og'],
//            'og_video' => ['title' => 'OG-video',  'type' => 'og'],
//            'h1' => ['title' => 'H1', 'max' => 191, 'form_type' => 'string',],
    ],
];
