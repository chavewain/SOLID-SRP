<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * Campos rellenables que acepta el modelo.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'is_active',
        'released_at',
        'image_path',
        'metadata',
    ];

    /**
     * Casteos para facilitar validaciones y accesos.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_active' => 'boolean',
        'released_at' => 'date',
        'metadata' => 'array',
    ];

    /**
     * Genera un slug automáticamente si no se proporciona.
     */
    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->slug) && filled($product->name)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
