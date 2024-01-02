<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomLog extends Model
{
    protected $table = 'custom_log';

    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'operation',
        'controller',
        'http_code',
        'route', 
        'status'
    ];
}
