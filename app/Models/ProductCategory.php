<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str; // Import Str Helper


class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['id','name', 'slug', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

     // Auto-generate slug before saving
     public static function boot()
     {
         parent::boot();
 
         static::creating(function ($category) {
             $category->slug = Str::slug($category->name);
         });
 
         static::updating(function ($category) {
             $category->slug = Str::slug($category->name);
         });
     }
}
