<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Database\Factories\DeliveryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'address',
        'city',
        'country'
    ];

    public function orders () {
        return this->BelongsTo(Order::class);
    }
}
