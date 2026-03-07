<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    protected $fillable = ['category_id', 'name', 'status'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function grandchilds(): HasMany
    {
        return $this->hasMany(Grandchild::class);
    }

    public function specGroups(): HasMany
    {
        return $this->hasMany(SpecGroup::class);
    }

    public function specFields(): HasMany
    {
        return $this->hasMany(SpecField::class);
    }
}
