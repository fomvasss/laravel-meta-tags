<?php
/**
 * Created by PhpStorm.
 * User: fomvasss
 * Date: 22.10.18
 * Time: 22:13
 */

namespace Fomvasss\LaravelMetaTags;

use Illuminate\Support\Facades\Facade as LFacade;

class Facade extends LFacade
{
    public static function getFacadeAccessor()
    {
        return Builder::class;
    }
}