<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gallery extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = ['name', 'grid_size', 'description', 'creator_id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function categories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'taxonomizable', 'gallery_taxonomizable');
    }

    public function tags()
    {

        return $this->morphedByMany(Tag::class, 'taxonomizable', 'gallery_taxonomizable');
    }

    public function scopeForName(Builder $query, ?string $search): Builder
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where('name', 'LIKE', "%$search%");
    }
    
    public function scopeForTag(Builder $query, ?int $tag): Builder
    {
        if (empty($tag)) {
            return $query;
        }

        return $query->whereHas('tags', function (Builder $query) use ($tag) {
            $query->where('tags.id', $tag);
        });
    }

    public function scopeForCategory(Builder $query, ?int $category): Builder
    {
        if (empty($category)) {
            return $query;
        }

        return $query->whereHas('categories', function (Builder $query) use ($category) {
            $query->where('categories.id', $category);
        });
    }
}
