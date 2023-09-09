<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='products';
    protected $appends=['image'];
    protected $guarded=[];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Product_Image::class,'product_id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Product_Comment::class,'product_id');
    }
    public function rates(): HasMany
    {
        return $this->hasMany(Product_Rate::class,'product_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,'product_id');
    }
    public function getImageAttribute($value)
    {
        return $this->images()->first();
    }

}
