<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'title',
        'description',
        'status',
    ];

    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } elseif ($value == 2) {
            return 'Inactive';
        }
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(ProductFile::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductFile::class)->where('type', 'image');
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(ProductFile::class)->where('type', '!=', 'image');
    }

    public function specValues(): HasMany
    {
        return $this->hasMany(ProductSpecValue::class);
    }
}
