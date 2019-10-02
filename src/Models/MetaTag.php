<?php

namespace Fomvasss\LaravelMetaTags\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'model_id', 'model_type'
    ];

    public function metatagable()
    {
        return $this->morphTo(config('meta-tags.database.morph_column.name'));
    }

    public function scopeByType($query, string $type = null)
    {
        return $query->where(config('meta-tags.database.morph_column.name').'_type', config("meta-tags.types.$type.model"));
    }

    public function scopeByPath($query, string $path = '/')
    {
        return $query->where('path', $path);
    }
}
