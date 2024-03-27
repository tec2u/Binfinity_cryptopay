<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletName extends Model
{
    use HasFactory;
    protected $table = 'wallets_name';
    protected $fillable = ['id_user', 'name', 'coin', 'active'];

}
