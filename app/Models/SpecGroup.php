<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecGroup extends Model
{
    protected $fillable = ['subcategory_id', 'title', 'sort_order'];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function specFields(): HasMany
    {
        return $this->hasMany(SpecField::class, 'group_id');
    }
}
