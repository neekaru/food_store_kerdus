<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Rating;

class Product extends Model
{
    /**
     * fillable product
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 
        'image', 
        'title', 
        'slug', 
        'description', 
        'price', 
        'weight'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    
}
