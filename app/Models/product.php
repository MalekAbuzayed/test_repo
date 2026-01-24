<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    // ===================================================================================================================
    // ============================================= Basic Section =======================================================
    // ===================================================================================================================
    protected $table = 'products';

    protected $fillable = [
        'name',
        'type',
        'title',
        'description',
        'image',
        'file',
        'status',
    ];

    // ===================================================================================================================
    // ============================================= Accessors Section ===================================================
    // ===================================================================================================================
    // status
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return 'Active';
        } elseif ($value == 2) {
            return 'Inactive';
        }
    }

    // type
    public function getTypeAttribute($value)
    {
        $types = [
            'batteries' => 'Batteries',
            'hybrid' => 'Hybrid',
            'onGrid' => 'OnGrid',
            'others'=> 'Others',
        ];

        return $types[$value] ?? $value;
    }
}