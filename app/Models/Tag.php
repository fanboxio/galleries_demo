<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['name'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Tag $tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }

    public function taxonomies()
    {
        return $this->morphToMany(Taxonomy::class, 'taxonomizable');
    }
}
