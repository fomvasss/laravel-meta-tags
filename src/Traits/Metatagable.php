<?php

namespace Fomvasss\LaravelMetaTags\Traits;

trait Metatagable
{
    protected static function bootMetatagable()
    {
        self::deleting(function ($model) {
            $model->seo()->delete();
        });
    }
    
    /**
     * Deprecated, will be replaced by seo()
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function metaTag()
    {
        return $this->seo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function seo()
    {
        $modelClass = config('meta-tags.model', \Fomvasss\LaravelMetaTags\Models\MetaTag::class);

        return $this->morphOne($modelClass, 'model');
    }
}