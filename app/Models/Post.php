<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'slug', 'title', 'excerpt', 'body'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
