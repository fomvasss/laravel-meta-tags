<?php

return [

    /* -----------------------------------------------------------------
     |  The default Model metatag
     | -----------------------------------------------------------------
     */
    'model' => \Fomvasss\LaravelMetaTags\Models\MetaTag::class,
    
    /* -----------------------------------------------------------------
     |  Available fields (for migration, render in blade,...)
     |  Uncoment nedded:
     | -----------------------------------------------------------------
     */
    'available' => [
        //  Meta-tags
        'title' => ['title' => 'Title'],                // recommend max => 60
        'description' => ['title' => 'Description'],    // recommend max => 300
        'keywords' => ['title' => 'Keywords'],          // recommend max => 300
        
        //  SEO fields
        // 'h1' => ['title' => 'H1'] // only for migration
        // 'canonical' => ['title' => 'Canonical link'],
        // 'robots' => ['title' => 'Robots'],
        // 'changefreq' => ['title' => 'Changefreq'],
        // 'priority' => ['title' => 'Priority'],
        
        //  OG-tags
        // 'og_site_name' => ['title' => 'OG-site_name', 'default' => '[site:name]', 'type' => 'og'],
        // 'og_locale' => ['title' => 'OG-locale', 'type' => 'og'],
        // 'og_title' => ['title' => 'OG-title', 'type' => 'og'],
        // 'og_description' => ['title' => 'OG-description', 'type' => 'og'],
        // 'og_type' => ['title' => 'OG-type', 'type' => 'og'],
        // 'og_image' => ['title' => 'OG-image', 'type' => 'og'],
        // 'og_url' => ['title' => 'OG-url', 'type' => 'og'],
        // 'og_audio' => ['title' => 'OG-audio', 'type' => 'og'],
        // 'og_determiner' => ['title' => 'OG-determiner', 'type' => 'og'],
        // 'og_video' => ['title' => 'OG-video',  'type' => 'og'],

        // 'fb_app_id' => ['title' => 'OG-title', 'type' => 'fb'], // do not saved in DB meta_tags table, saved, for example, in config!
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
     |  This is example, for dashboard SEO form,...
     |  Available values
     |  This list is a sample and is not used in the package
     | -----------------------------------------------------------------
     */
    'values' => [
        'robots' => ['none', 'all', 'index', 'noindex', 'nofollow', 'follow',],
        'changefreq' => ['always', 'daily', 'hourly', 'weekly',],
        'priority' => [0.1, 0.2, 0.3, 0.5, 0.6, 0.7, 0.8, 0.9,],
    ],
];
