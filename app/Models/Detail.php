<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Database\Factories\DetailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Detail extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'quantity',
    ];

    
}
