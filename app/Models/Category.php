<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Category $category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function galleries()
    {
        return $this->morphToMany(Gallery::class, 'taxonomizable');
    }
}
