<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricScore extends Model
{
    use HasFactory;

    protected $table = 'historic_score';

    protected $fillable = [
        'user_id',
        'orders_package_id',
        'description',
        'score',
        'status',
        'user_id_from',
        'level_from',
    ];

    /**
     * Relacionamentos de Tabelas
     */
    #region relacionamento
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->hasMany(OrderPackage::class);
    }

    public function config_bonus(){
        return $this->belongsTo(ConfigBonus::class,'description');
    }

    public function getUserFrom($id)
    {
        $user_from = User::find($id);
        return $user_from->name;
    }

    #endregion
}
