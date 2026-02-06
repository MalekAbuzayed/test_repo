<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'title_ar',
        'title_en',
        'subtitle_ar',    // جديد: العنوان الفرعي
        'subtitle_en',    // جديد
        'description_ar',
        'description_en',
        'bold_description_ar', // جديد: النص الغامق
        'bold_description_en', // جديد
        'icon',           // جديد: الأيقونة
        'image',
    ];
}
