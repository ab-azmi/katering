<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //relation to order items
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    //relation to merchant
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    //relation to customer
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
