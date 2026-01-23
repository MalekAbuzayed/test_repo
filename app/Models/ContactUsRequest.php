<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsRequest extends Model
{
    use HasFactory;

    // ===================================================================================================================
    // ============================================= Basic Section =======================================================
    // ===================================================================================================================
    protected $table = 'contact_us_requests';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}
