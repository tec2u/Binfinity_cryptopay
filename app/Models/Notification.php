<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'resume',
        'description',
        'user_id'
    ];

    /**
    * Relacionamento de Tabelas
    */
    #region relacionamento
    public function user(){
        return $this->hasMany(User::class);
    }
    #endregion
}
