<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawWallet extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'wallet_address', 'crypto'];

}
