<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodeOrders extends Model
{
    use HasFactory;

    protected $table = 'node_orders';

    protected $fillable = [
        'id_order',
        'id_user',
        'price',
        'price_crypto',
        'price_crypto_payed',
        'wallet',
        'validity',
        'status',
        'coin',
        'hash',
        'notify_url',
        'notified',
        'withdrawn',
        'type',
    ];

}
