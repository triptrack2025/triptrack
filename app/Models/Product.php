<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'product_category_id', 
        'name', 
        'slug', 
        'description', 
        'price', 
        'cancelled_price', 
        'stock', 
        'is_best_seller',  
        'is_popular_product'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Auto-generate unique slug before saving
    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $slug = Str::slug($product->name);
            $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
            $product->slug = $count ? "{$slug}-" . ($count + 1) : $slug;
        });

        static::updating(function ($product) {
            $slug = Str::slug($product->name);
            $count = Product::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $product->id)->count();
            $product->slug = $count ? "{$slug}-" . ($count + 1) : $slug;
        });

        static::deleting(function ($product) {
            foreach ($product->images as $image) {
                if (file_exists(public_path($image->image))) {
                    unlink(public_path($image->image));
                }
                $image->delete();
            }
        });
    }
}
