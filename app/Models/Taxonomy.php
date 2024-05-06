<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * This class is used as an universal model for all taxonomies in the system.
 * Only extending this class is enough to use all taxonomy functionallities in the system.
 * 
 * Whenever any taxonomy instance is created, 'slug' field is created based on taxonomy name
 * and attached to the model.
 * 
 * Relationship with galleries is defined through 'gallery_taxonomizable' DB table where name of
 * the relationship is 'taxonomizable'.
 * 
 * To find taxonomy by slug, use forSlug scope.
 */
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
