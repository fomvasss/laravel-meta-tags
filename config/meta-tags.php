<?php

return [

    /* -----------------------------------------------------------------
     |  The default Model metatag
     | -----------------------------------------------------------------
     */
    'model' => \Fomvasss\LaravelMetaTags\Models\MetaTag::class,
    
    /* -----------------------------------------------------------------
     |  Available meta-tags (for migration, render in blade,...)
     |  Uncoment nedded:
     | -----------------------------------------------------------------
     */
    'available' => [
        // 'h1' => ['title' => 'H1'], // it is not meta-tag!

        /* -----------------------------------------------------------------
         |  Default meta-tags
         | -----------------------------------------------------------------
         */
        'title' => ['title' => 'Title'], // recommend max => 60
        'description' => ['title' => 'Description'], // recommend max => 300
        'keywords' => ['title' => 'Keywords',], // recommend max => 300
        
        /* -----------------------------------------------------------------
         |  Robots tag value: 'none', 'all', 'index', 'noindex', 'nofollow', 'follow',
         | -----------------------------------------------------------------
         */
        // 'robots' => ['title' => 'Robots'],
    
        /* -----------------------------------------------------------------
         |  Canonical link
         | -----------------------------------------------------------------
         */
        // 'canonical' => ['title' => 'Canonical link'],
    
        /* -----------------------------------------------------------------
         |  OG-tags
         | -----------------------------------------------------------------
         */
        // 'fb_app_id' => ['title' => 'OG-title', 'type' => 'fb'], // do not saved in DB meta_tags table, saved, for example, in config!

        // 'og_title' => ['title' => 'OG-title', 'type' => 'og'],
        // 'og_description' => ['title' => 'OG-description', 'type' => 'og'],
        // 'og_type' => ['title' => 'OG-type', 'type' => 'og'],
        // 'og_image' => ['title' => 'OG-image', 'type' => 'og'],
        // 'og_url' => ['title' => 'OG-url', 'type' => 'og'],
        // 'og_audio' => ['title' => 'OG-audio', 'type' => 'og'],
        // 'og_determiner' => ['title' => 'OG-determiner', 'type' => 'og'],
        // 'og_locale' => ['title' => 'OG-locale', 'type' => 'og'],
        // 'og_site_name' => ['title' => 'OG-site_name', 'default' => '[site:name]', 'type' => 'og'],
        // 'og_video' => ['title' => 'OG-video',  'type' => 'og'],
    ],

    'default' => [
        'og_image' => [
            'type' => 'image/png',
            'width' => '780',
            'height' => '780',
        ],
        'fb_app_id' => '',
    ],
    
    /* -----------------------------------------------------------------
     |  Available robots elements (example, for user admin form,...)
     |  Next list is a sample and don't used in this package
     | -----------------------------------------------------------------
     */
    'robots_element' => ['none', 'all', 'index', 'noindex', 'nofollow', 'follow']
];
