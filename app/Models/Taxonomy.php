<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    protected $fillable = ['taxonomizable_type', 'taxonomizable_id'];

    public function taxonomizable()
    {
        return $this->morphTo();
    }
}
