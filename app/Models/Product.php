<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'info', 'price', 'href', 'count','category_id'];
    public $timestamps = false;

    public function basket(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Basket::class);
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function favorite(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Favorite::class);
    }
    public function getImageAttribute()
    {
        return url('/storage/' . $this->attributes['href']);
    }
    public function setImageAttribute($value)
    {
        return $this->attributes['href'] = $value;
    }
}
