<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Detail;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'amount',
        'status',
        'delivery_id',
        'payment_id',
        'client_id',
    ];

    public function client (): BelongsTo {
        return $this->BelongsTo(User::class);
    }

   public function delivery(): BelongsTo {
        return $this->belongsTo(Delivery::class);
    }

    public function payment(): BelongsTo {
        return $this->belongsTo(Payment::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'details', 'order_id', 'product_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
