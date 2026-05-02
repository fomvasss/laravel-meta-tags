**Recommended: use [fomvasss/laravel-seo](https://github.com/fomvasss/laravel-seo).**


# Laravel Meta Tags

[![License](https://img.shields.io/packagist/l/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://packagist.org/packages/fomvasss/laravel-meta-tags)
[![Build Status](https://img.shields.io/github/stars/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://github.com/fomvasss/laravel-meta-tags)
[![Latest Stable Version](https://img.shields.io/packagist/v/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://packagist.org/packages/fomvasss/laravel-meta-tags)
[![Total Downloads](https://img.shields.io/packagist/dt/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://packagist.org/packages/fomvasss/laravel-meta-tags)
[![Quality Score](https://img.shields.io/scrutinizer/g/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://scrutinizer-ci.com/g/fomvasss/laravel-meta-tags)

## Support

If this package is useful to you, consider supporting its development:

[![Monobank](https://img.shields.io/badge/Donate-Monobank-black)](https://send.monobank.ua/jar/5xsqtHvVrY)
[![Ko-Fi](https://img.shields.io/badge/Donate-Ko--fi-FF5E5B?logo=ko-fi&logoColor=white)](https://ko-fi.com/fomvasss)
[![USDT TRC20](https://img.shields.io/badge/Donate-USDT%20TRC20-26A17B?logo=tether&logoColor=white)](https://link.trustwallet.com/send?coin=195&address=THLgp6DxiAtbNHvgnKV56vk1L38UuUagKf&token_id=TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t)

> USDT TRC20 address: `THLgp6DxiAtbNHvgnKV56vk1L38UuUagKf`

This package lets you manage meta tags and SEO fields from Laravel controllers and Blade templates.

----------

## Installation

Run from the command line:

```bash
composer require fomvasss/laravel-meta-tags
```

### Publish and Configure

1) Publish assets from the command line:

```bash
php artisan vendor:publish --provider="Fomvasss\LaravelMetaTags\ServiceProvider"
```
- A configuration file will be published to `config/meta-tags.php`.
- A migration file will be published to `database/migrations/DATE_NOW_create_meta_tags_table.php`.
- A customizable Blade template file will be published to `resources/views/vendor/meta-tags/tags.blade.php`.

2) Adjust published assets:

- Set available tags in `config/meta-tags.php` (uncomment what you need).
- Optionally set your own meta tag model class in `config/meta-tags.php`.
- Edit the `meta_tags` migration and uncomment the fields you need.

3) Run migration:
```bash
php artisan migrate
```

---

## Upgrading

When upgrading from v2 to v3, please see the [UPGRADING.md](UPGRADING.md)

---

## Integration & Usage

### Usage in Eloquent models: `app/Models/Article.php`

Add `Metatagable` trait in your entity model:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Fomvasss\LaravelMetaTags\Traits\Metatagable;

class Article extends Model
{
    use Metatagable;
    //...
}
```

Controller example: `app/Http/Controllers/ArticleController.php`

### Using the `MetaTag` facade in controllers: `app/Http/Controllers/ArticleController.php`

```php
<?php 

namespace App\Http\Controllers;

use MetaTag;

class ArticleController extends Controller 
{
    public function index()
    {
        $articles = \App\Models\Article::paginate();
        
        MetaTag::setTags([
            'title' => 'Article index page',
            'description' => 'It is article index page',
        ]);

        return view('index', compact('articles'));
    }
    
    public function store(Request $request)
    {
    	// create entity
        $article = \App\Models\Article::create($request->only([
            //.. article data
        ]));

		// create meta tag for entity
        $article->metaTag()->create($request->only([
            //.. meta tags fields
        ]));
    }

    public function show($id)
    {
        $article = \App\Model\Article::findOrFail($id);
        
        // Set tags for showing
        MetaTag::setEntity($article)
            ->setDefault([
                'title' => $article->title, // if empty $article->metaTag->title - show this title
			])->setTags([
				'seo_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
				'h1' => $article->title,   
			]);
        
        return view('show', compact('article'));
    }

    public function search(Request $request)
    {
        $articles = \App\Models\Article::bySearch($request->q)
            ->paginate();
        
        // Set tags for showing
        MetaTag::setPath()  // if argument `setPath()` is empty (or not set) - path = `request()->path()`
            ->setDefault([
                'title' => 'Search page',
                'robots' => 'noindex',
                'og_title' => 'Search page OG',
                'twitter_title' => 'Search page Twitter',
                'canonical' => 'page/search',
            ]);
        
        return view('index', compact('articles'));
    }
}
```

For the package to work correctly, store only the URL path in the `path` field (without domain), with slashes trimmed (`/`).

Example:
- `https://site.com/some/pages/?page=23` => `some/pages`
- `https://site.com/some/pages` => `/`


### Using the `MetaTag` facade in Blade templates: `resources/views/layouts/app.blade.php`

Simple and efficient:

```blade
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8">

        {!! MetaTag::render() !!}
        
    </head>
    <body>
        @yield('content')
    </body>
</html>
```

Or output one by one manually:

```blade
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8">

        <title>{!! MetaTag::tag('title') !!}</title>
        <meta name="description" content="{!! MetaTag::tag('description') !!}">
        <meta name="keywords" content="{!! MetaTag::tag('keywords') !!}">
        
    </head>
    <body>
        @yield('content')
    </body>
</html>
```

Another example: `resources/views/articles/show.blade.php`

```blade
@extends('layouts.app')
@section('content')
	<h1>{!! MetaTag::tag('title') !!}</h1>
	<div>{!! $article->body !!}</div>
	<div>{{ MetaTag::tag('seo_text') }}</div>
@endsection
```

And you can set meta tags right in the template:

```blade
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        
        @php(MetaTag::setEntity($article))
        @php(MetaTag::setDefault(['description' => 'My default meta tag']))
        
        {!! MetaTag::render() !!}
        
    </head>
    <body>
        @yield('content')
    </body>
</html>
```

Similarly:

```blade
{!!
    \MetaTag::setEntity($article)
        ->setDefault(['description' => 'My default meta tag'])
        ->render()
    !!}
```

```blade
{!! 
    \MetaTag::setPath('articles')
        ->setDefault(['robots' => 'follow', 'canonical' => 'page/articles'])
        ->setDefault(['title' => 'All articles'])
        ->setDefault(['og_title' => 'All articles'])
        ->setDefault(['og_locale' => 'de'])
        ->setDefault(['og_image' => 'files/images/5be3d92e02a55890e4301ed4.jpg', 'og_image_height' => 123])
        ->render() 
!!}
```

## Links

* [Use this package for URL aliases](https://github.com/fomvasss/laravel-url-aliases)
