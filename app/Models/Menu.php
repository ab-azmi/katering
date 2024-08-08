<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //relation to merchant
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    //relation to fotos
    public function fotos(): HasMany
    {
        return $this->hasMany(Foto::class);
    }
}
