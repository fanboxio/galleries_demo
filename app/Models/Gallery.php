<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gallery extends Model implements HasMedia
{
    use InteractsWithMedia;

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
}
