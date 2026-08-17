<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'status',
        'price',
        'description',
        'features',
        'image_description',
        'image_1',
        'image_2',
        'image_3',
        'category_id',
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class)
                    ->withPivot('quantities')
                    ->withTimestamps();
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'details', 'order_id', 'product_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}