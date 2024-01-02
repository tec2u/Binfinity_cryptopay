<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reference',
        'payment_status',
        'transaction_code',
        'transaction_wallet'
    ];

    /**
     * Relacionamento tabelas
    */
    #region relacionamento 
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    #endregion
}
