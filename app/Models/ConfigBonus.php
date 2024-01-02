<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigBonus extends Model
{
    use HasFactory;

    protected $table = 'config_bonus';

    protected $fillable = [
        'description',
        'activated'
    ];

    /**
     * Relacionamento tabelas
    */
    #region relacionamento 
    
    public function banco()
    {
        return $this->belongsTo(Banco::class,'description');
    }

    public function score()
    {
        return $this->belongsTo(Banco::class,'description');
    }
    #endregion
}
