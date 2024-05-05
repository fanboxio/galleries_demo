<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Taxonomy extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($taxonomy) {
            $taxonomy->slug = Str::slug($taxonomy->name);
        });
    }

    public function galleries()
    {
        return $this->morphToMany(Gallery::class, 'taxonomizable', 'gallery_taxonomizable');
    }

    public function scopeForSlug(Builder $query, string $slug)
    {
        return $query->where('slug', $slug);
    }
}
