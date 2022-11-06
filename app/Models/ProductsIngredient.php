<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsIngredient extends Model
{
    use HasFactory;
    protected $table = "products_ingredients";

    public $timestamps = false;

    public function ingredient(){
        return $this->hasMany(Ingredient::class, 'id', 'ingredient_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
