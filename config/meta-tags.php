<?php

return [
    /* -----------------------------------------------------------------
     |  The default tag values
     | -----------------------------------------------------------------
     */
    'default' => [
        'title' => env('APP_NAME'),
        
        'og_image' => [
            'type' => 'image/png',
            'width' => '780',
            'height' => '780',
        ],
        
        'fb_app_id' => env('SEO_FB_ID', null),
    ],

    /* -----------------------------------------------------------------
     |  Will be render in blade
     |  Uncomment needed
     | -----------------------------------------------------------------
     */
    'available' => [
        // Main
        'title' => ['title' => 'Title'],                // recommend max => 60
        'description' => ['title' => 'Description'],    // recommend max => 300
        'keywords' => ['title' => 'Keywords'],          // recommend max => 300

        // OG-tags
        'og_site_name' => ['title' => 'OG-site name'],
        'og_locale' => ['title' => 'OG-locale'],
        'og_title' => ['title' => 'OG-title'],
        'og_description' => ['title' => 'OG-description'],
        'og_type' => ['title' => 'OG-type'],
        'og_image' => ['title' => 'OG-image'],
        'og_url' => ['title' => 'OG-url'],
        'og_audio' => ['title' => 'OG-audio'],
        'og_determiner' => ['title' => 'OG-determiner'],
        'og_video' => ['title' => 'OG-video'],

        // Twitter tags
        'twitter_title' => ['title' => 'Twitter domain'],
        'twitter_description' => ['title' => 'Twitter description'],
        'twitter_card' => ['title' => 'Twitter card'],
        'twitter_site' => ['title' => 'Twitter site'],
        'twitter_creator' => ['title' => 'Twitter creator'],
        'twitter_image' => ['title' => 'Twitter image'],
        'twitter_domain' => ['title' => 'Twitter domain'],

        // Additional fields
        'canonical' => ['title' => 'Canonical link'],
        'robots' => ['title' => 'Robots'],
        'fb_app_id' => ['title' => 'Facebook app ID'],
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


    /* -----------------------------------------------------------------
     |  The default Model meta-tag
     | -----------------------------------------------------------------
     */
    'model' => \Fomvasss\LaravelMetaTags\Models\MetaTag::class,
];
