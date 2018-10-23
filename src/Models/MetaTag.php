<?php

namespace Fomvasss\LaravelMetaTags\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    public $timestamps = false;

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'id', 'path', 'metatagable_id', 'metatagable_type'
    ];

    public function metatagable()
    {
        return $this->morphTo();
    }

    public function scopeByType($query, string $type = null)
    {
        if ($type) {    
            return $query->where('metatagable_type', config("meta-tags.types.$type.model"));
        }

        return $query->where('metatagable_type', null)->orWhere('metatagable_type', '');
    }


    public function scopeByPath($query, string $path = null)
    {
        return $query->where('path', $path);
    }
}
