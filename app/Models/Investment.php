<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $table = 'investment';

    protected $fillable = [
        'user_name', 
        'package_name', 
        'price', 
        'total_returns', 
        'minting_month', 
        'payment_status', 
        'created_at'
    ];

    /*
    Relacionamento de Tabelas
    */

    #region
    #endregion

}
