<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenValue extends Model
{
    use HasFactory;

    protected $table = 'token_value';

    protected $fillable = [
        'id',
        'name',
        'value_usd',
        'dally_retuns'
    ];


}
