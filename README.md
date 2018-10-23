# Laravel Meta Tags

With this package you can manage Meta Tags from Laravel controllers.

----------

## Installation

Run from the command line:

```bash
composer require fomvasss/laravel-meta-tags
```

### Publish the configurations

Run this on the command line:

```
$ php artisan vendor:publish --provider="Fomvasss\LaravelMetaTags\ServiceProvider"
```
- A configuration file will be publish to `config/meta-tags.php`.
- A migration file will be publish to `database/migrations/DATE_NOV_create_meta_tags_table.php`.
- A blade template file will be publish to `resources/views/vondor/meta-tags/tags.blade.php`.


## Examples usage

#### app/Models/Article.php

Add `Metatagable` trait in your model:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Metatagable;
    //...
}
```

#### app/Http/Controllers/ArticleController.php

Use `MetaTag` facade in your controllers or blade templates:

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
            //.. meta tags data
        ]));
        
        //..
    }

    public function show($id)
    {
        $article = \App\Model\Article::findOrFail($id);

        MetaTag::setEntity($article)
            ->setTags(['title' => $article->title]); // set custom field
        
        return view('stow', compact('article'));
    }

    public function search(Request $request)
    {
        $articles = \App\Model\Article::bySearch($request->q)
            ->paginate();

        MetaTag::setPath(); // default - request()->path()
        
        return view('index', compact('articles'));
    }
}
```

#### resources/views/layouts/app.blade.php

```php
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8">

        <title>{{ MetaTag::get('title') }}</title>

        {!! MetaTag::tag('description') !!}
        {!! MetaTag::tag('keywords') !!}
    </head>

    <body>
        @yield('content')
    </body>
</html>
```

**Or you can use a pre-made template for output:**

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

**And you can set meta tags right in the template:**

```php
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8">

        {!! MetaTag::setEntity($article) !!}
        {!! MetaTag::setTags(['description' => 'My custom meta tag']) !!}
        {!! MetaTag::render() !!}
    </head>

    <body>
        @yield('content')
    </body>
</html>
```

Similarly:
```php
{!!
    MetaTag::setEntity($article)
        ->setTags(['description' => 'My custom meta tag'])
        ->render()
!!}
```