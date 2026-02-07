<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'team_members';

    protected $fillable = [
        'name_ar',
        'name_en',
        'position_ar',
        'position_en',
        'description_ar',
        'description_en',
        'image',
        'order',
        'is_active',
    ];

    protected $attributes = [
        'order' => 0,
        'is_active' => true,
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        $name = urlencode($this->name_en);
        return "https://ui-avatars.com/api/?name={$name}&size=150&background=c52c26&color=fff&bold=true";
    }
}
