<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merchant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //relation to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //relation to menus
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
