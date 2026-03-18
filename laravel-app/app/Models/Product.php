<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'image',
        'brand',
        'model',
        'series',
        'category',
        'type',
        'color',
        'short_description',
        'specs',
        'price',
        'discount_price',
        'stock',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'specs' => 'array',
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class)->where('is_approved', true);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function getCurrentPriceAttribute(): string
    {
        return (string) ($this->discount_price ?: $this->price);
    }
}
