<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecField extends Model
{
    protected $fillable = [
        'subcategory_id',
        'group_id',
        'key',
        'label',
        'unit',
        'data_type',
        'is_key',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'is_key' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(SpecGroup::class, 'group_id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(ProductSpecValue::class, 'spec_field_id');
    }
}
