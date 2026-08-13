<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'amount',
        'status'
    ];

    public function clients () {
        return this->BelongsTo(User::class);
    }

    public function deliveries () {
        return this->HasOne(Delivery::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('details')
                    ->withTimestamps();
    }
}
