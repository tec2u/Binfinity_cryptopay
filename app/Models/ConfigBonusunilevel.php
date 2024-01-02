<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigBonusunilevel extends Model
{
    protected $table = 'config_bonusunilevel';

    use HasFactory;

    protected $fillable = [
        'id',
        'level',
        'decription',
        'value_percent',
        'user_activated',
        'max_price',
        'status',
        'created_at',
        'updated_at',
        'minimum_users',
    ];

    /**
     * Relacionamento tabelas
    */
    #region relacionamento 
    
    #endregion
}
