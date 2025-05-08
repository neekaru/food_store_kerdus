<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    /**
     * fillable category
     * 
     * @var array
     */
    protected $fillable = ['image', 'name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
