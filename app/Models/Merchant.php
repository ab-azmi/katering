<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($merchant) {
            if ($merchant->isDirty('name')) {
                $merchant->slug = Str::slug($merchant->name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

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
