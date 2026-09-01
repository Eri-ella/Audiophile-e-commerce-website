<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'type',
        'status',
        'fedapay_id',
    ];

    // Un payment appartient à UNE commande
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}