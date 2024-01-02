<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpBlacklist extends Model
{
    use HasFactory;

    protected $table = 'ip_blacklist';

    protected $fillable = [
        'ip',
        'login',
        'password',
        'updated_at',
        'created_at',
    ];

    /*
    Relacionamento de Tabelas
    */

    #region
    #endregion

}
