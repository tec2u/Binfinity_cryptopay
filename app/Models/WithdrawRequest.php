<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    protected $table = 'withdraw_requests';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_code',
        'value',
        'date_payment',
        'processing_user', 
        'status',
        'message',
        'type',
    ];

    /**
     * Relacionamento tabelas
    */
    #region relacionamento 
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    #endregion

    public function userPayment(WithdrawRequest $withdraw)
    {
        $user = User::where('id', $withdraw->processing_user )->get();

        return $user[0]->name;
    }
}
