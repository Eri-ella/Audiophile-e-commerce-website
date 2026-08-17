<?php

namespace App\Models;
// use Database\Factories\PaymenyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'type',
        'number',
        'pin',
    ];

    public function orders () {
        return $this->hasOne(Order::class);
    }
}
