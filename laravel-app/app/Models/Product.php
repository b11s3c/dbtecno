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
        'price',
        'stock',
        'specs',
    ];

    protected function casts(): array
    {
        return [
            'specs' => 'array',
            'price' => 'decimal:2',
        ];
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class);
    }
}
