<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $table = 'payment_log';

    use HasFactory;

    protected $fillable = [
        'content',
        'order_package_id',
        'operation',
        'controller',
        'http_code',
        'route', 
        'status',
        'json'
    ];
}
