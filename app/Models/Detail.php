<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Database\Factories\DetailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use App\Models\Product;
// use App\Models\Order;

class Detail extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'quantity',
        'order_id',
        'product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    
    // public function order(): HasOne
    // {
    //     return $this->hasOne(Order::class);
    // }
}
