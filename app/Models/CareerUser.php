<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerUser extends Model
{
    use HasFactory;

    protected $table = 'career_users';

    protected $fillable = [
        'user_id',
        'career_id',
    ];

    /**
     * Relacionamentos de Tabelas
     */
    #region relacionamento
    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    #endregion
}
