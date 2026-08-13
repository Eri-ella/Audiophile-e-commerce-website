<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'status'
    ];
}
