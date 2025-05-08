<?php

namespace App\Models;

use App\Models\Rating;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

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
    

    protected static function boot()
    {
        parent::boot();

        // Generate slug before saving
        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug =  Str::slug($product->title);
            }
        });
    }
}
