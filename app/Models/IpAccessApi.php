<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpAccessApi extends Model
{
    use HasFactory;
    protected $table = 'ip_access_api';

    protected $fillable = [
        'ip',
        'json_data',
    ];
}
