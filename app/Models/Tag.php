<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Tag $tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }

    public function galleries()
    {
        return $this->morphToMany(Gallery::class, 'taxonomizable');
    }
}
