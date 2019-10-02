<?php

namespace Fomvasss\LaravelMetaTags\Traits;

trait Metatagable
{
    public function metaTag()
    {
        $modelClass = config('meta-tags.model', \Fomvasss\LaravelMetaTags\Models\MetaTag::class);

        return $this->morphOne($modelClass, config('meta-tags.database.morph_column.name'));
    }
}