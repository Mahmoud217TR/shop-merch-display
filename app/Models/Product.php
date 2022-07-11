<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'category_id'
    ];

    // Relations
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // The Accessor & Mutator
    public function image(): Attribute{
        return Attribute::make(
            get: fn ($value) => $value??asset('images/product.svg'),
        );
    }
}
