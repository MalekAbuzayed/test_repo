<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurVision extends Model
{
    use HasFactory;

    protected $table = 'our_visions';

    protected $fillable = [
        'icon',
        'title_ar',
        'title_en',
        'bold_description_ar',
        'bold_description_en',
        'normal_description_ar',
        'normal_description_en',
        'is_active',
    ];

    protected $attributes = [
        'icon' => 'lightbulb',
        'title_ar' => 'رؤيتنا',
        'title_en' => 'Our Vision',
        'is_active' => true,
    ];
}
