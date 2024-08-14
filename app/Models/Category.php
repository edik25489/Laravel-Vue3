<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'href'];
    public $timestamps = false;

    public function product(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function discount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Discount::class);
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
