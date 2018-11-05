<?php

return [
    /*
     * The default Model metatag
     */
    'model' => \Fomvasss\LaravelMetaTags\Models\MetaTag::class,

    /*
     * Available metatags (for migration, render in blade,...) - uncoment nedded:
     */
    'available' => [
        'title' => ['title' => 'Title', 'max' => 65, 'form_type' => 'string',],
        'description' => ['title' => 'Description', 'max' => 300, 'form_type' => 'text',],
        'keywords' => ['title' => 'Keywords',],
//        'h1' => ['title' => 'H1', 'max' => 191, 'form_type' => 'string',],

        /*
         * Robots tag value: 'none', 'all', 'index', 'noindex', 'nofollow', 'follow',
         */
//        'robots' => ['title' => 'Robots', 'max' => 65, 'form_type' => 'string',],
    
        /*
         * Canonical link 
         */
//        'canonical' => ['title' => 'Canonical link', 'max' => 65, 'form_type' => 'string',],
    
        /*
         * OG-tags 
         */
//        'og_title' => ['title' => 'OG-title', 'type' => 'og'],
//        'og_description' => ['title' => 'OG-description', 'type' => 'og'],
//        'og_type' => ['title' => 'OG-type', 'type' => 'og'],
//        'og_image' => ['title' => 'OG-image', 'type' => 'og'],
//        'og_url' => ['title' => 'OG-url', 'type' => 'og'],
//        'og_audio' => ['title' => 'OG-audio', 'type' => 'og'],
//        'og_determiner' => ['title' => 'OG-determiner', 'type' => 'og'],
//        'og_locale' => ['title' => 'OG-locale', 'type' => 'og'],
//        'og_site_name' => ['title' => 'OG-site_name', 'default' => '[site:name]', 'type' => 'og'],
//        'og_video' => ['title' => 'OG-video',  'type' => 'og'],
    ],
    
    /*
     * Available robots elements (example, for user admin form,...)
     */
    'robots_element' => ['none', 'all', 'index', 'noindex', 'nofollow', 'follow']
];
