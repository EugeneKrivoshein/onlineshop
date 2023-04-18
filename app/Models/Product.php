<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'name', 
        'description', 
        'slug', 
        'categories_id', 
        'price', 
        'characteristics'
    ];


    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
