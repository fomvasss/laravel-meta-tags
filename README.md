# Laravel Meta Tags

[![License](https://img.shields.io/packagist/l/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://packagist.org/packages/fomvasss/laravel-meta-tags)
[![Build Status](https://img.shields.io/github/stars/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://github.com/fomvasss/laravel-meta-tags)
[![Latest Stable Version](https://img.shields.io/packagist/v/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://packagist.org/packages/fomvasss/laravel-meta-tags)
[![Total Downloads](https://img.shields.io/packagist/dt/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://packagist.org/packages/fomvasss/laravel-meta-tags)
[![Quality Score](https://img.shields.io/scrutinizer/g/fomvasss/laravel-meta-tags.svg?style=for-the-badge)](https://scrutinizer-ci.com/g/fomvasss/laravel-meta-tags)

With this package you can manage Meta Tags from Laravel controllers.

----------

## Installation

Run from the command line:

```bash
composer require fomvasss/laravel-meta-tags
```

If you want to use the facade, add this to de bottom of `config/app.php` And, for convenience, add a facade alias to this same file at the bottom:
```php
'MetaTag' => Fomvasss\LaravelMetaTags\Facade::class
```


### Publish and settings

1) Publish assets - run this on the command line:

```bash
php artisan vendor:publish --provider="Fomvasss\LaravelMetaTags\ServiceProvider"
```
- A configuration file will be publish to `config/meta-tags.php`.
- A migration file will be publish to `database/migrations/DATE_NOW_create_meta_tags_table.php`.
- A customizable blade template file will be publish to `resources/views/vondor/meta-tags/tags.blade.php`.

2) Edit assets:

 - Set available tags in`config/meta-tags.php` - uncomment needed
 - If needed - set own model class for meta-tags in`config/meta-tags.php`
 - Edit migration meta_tags file - set available table field tags - uncomment needed

3) Run migration
```
php artisan migrate
```

## Examples usage

#### app/Models/Article.php

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

```
app/Http/Controllers/ArticleController.php:
```

### Use `MetaTag` facade in your controllers or blade templates

```php
<?php 

namespace App\Http\Controllers;

use MetaTag;

class HomeController extends Controller 
{
    public function index()
    {
        $articles = \App\Model\Article::paginate();
        
        MetaTag::setTags([
            'title' => 'Article index page',
            'description' => 'It is article index page',
        ]);

        return view('index', compact('articles'));
    }
    
    public function store(Request $request)
    {
        $article = \App\Model\Article::create($request->only([
            //.. article data
        ]));


        $article->metaTag()->create($request->only([
            //.. meta tags fields
        ]));
        // similar but harder:
        Fomvasss\LaravelMetaTags\Models\MetaTag::create([
            'metatagable_id' => $article->id,
            'metatagable_type' => get_class($article),
			//.. meta tags fields
		]);
        
        //..
    }

    public function show($id)
    {
        $article = \App\Model\Article::findOrFail($id);

        MetaTag::setEntity($article)
            ->setDefault(['title' => $article->title]); // if empty $article->metaTag->title - show this title
        
        return view('stow', compact('article'));
    }

    public function search(Request $request)
    {
        $articles = \App\Model\Article::bySearch($request->q)
            ->paginate();

        MetaTag::setPath()  // if argument `setPath()` is empty (or not set) - path = `request()->path()`
            ->setDefault([
                'title' => 'Search page',
                'robots' => 'noindex',
                'og_title' => 'Search page',
                'canonical' => 'page/search'
            ]);
        
        return view('index', compact('articles'));
    }
}
```

> **If you store meta tags for path - set field `path` without domain!**

Also you can use helper `meta_tag_prepare_path()` for clear url path before seved to DB.

```
resources/views/layouts/app.blade.php:
```

```php
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8">

        <title>{!! MetaTag::get('title') !!}</title>
        <meta name="description" content="{!! MetaTag::tag('description') !!}">
        <meta name="keywords" content="{!! MetaTag::tag('keywords') !!}">
        
    </head>
    <body>
        @yield('content')
    </body>
</html>
```

Or you can use a pre-made template for output:

```php
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

And you can set meta tags right in the template:

```php
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
        ->setDefault(['fb_app_id' => config('meta-tags.default.fb_app_id'),])
        ->setDefault(['robots' => 'follow', 'canonical' => 'page/articles'])
        ->setDefault(['title' => 'All articles'])
        ->setDefault(['og_title' => 'All articles'])
        ->setDefault(['og_locale' => 'de'])
        ->setDefault(['og_image' => 'files/images/5be3d92e02a55890e4301ed4.jpg', 'og_image_height' => 123])
        ->render() 
!!}
```

## Links

* [Use perfect package for url-aliases](https://github.com/fomvasss/laravel-url-aliases)