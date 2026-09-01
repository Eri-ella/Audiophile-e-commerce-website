<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Database\Factories\QuantityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Quantity extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'value',
        'content_id',
        'product_id',
    ];
}
