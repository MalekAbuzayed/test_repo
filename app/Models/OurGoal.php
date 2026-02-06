<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurGoal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'our_goals';

    protected $fillable = [
        'icon',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'order',
        'is_active',
    ];

    protected $attributes = [
        'icon' => 'trophy',
        'order' => 0,
        'is_active' => true,
    ];

    // Scope for active goals
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }
}
