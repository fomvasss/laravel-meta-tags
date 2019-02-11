<?php

namespace Fomvasss\LaravelMetaTags\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'metatagable_id', 'metatagable_type'
    ];

    public function metatagable()
    {
        return $this->morphTo();
    }

    public function scopeByType($query, string $type = null)
    {
        return $query->where('metatagable_type', config("meta-tags.types.$type.model"));
    }
    
    public function scopeByPath($query, string $path = null)
    {
        return $query->where('path', $path);
    }
}
