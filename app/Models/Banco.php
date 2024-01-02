<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $table = 'banco';

    protected $fillable = [
        'user_id',
        'order_id',
        'description',
        'price',
        'status',
        'level_from',
        'user_id_from',
    ];

    /*
    Relacionamento de Tabelas
    */

    #region
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function config_bonus()
    {
        return $this->belongsTo(ConfigBonus::class, 'description');
    }

    public function getUserOrder($id, $type = null)
    {
        if (!isset($type) || $type == 'order_id') {
            $user_from = OrderPackage::find($id);
            if (isset($user_from)) {
                $user = User::where('id', $user_from->user_id)->first();
                return $user->name;
            }
            return "";
        } else if ($type == 'user_id') {
            $user = User::where('id', $id)->first();
            if (isset($user)) {
                return $user->name;
            } else {
                return "";
            }
        }
    }

    public static function verifyBonusDaily($id_order)
    {
        return Banco::where('order_id', $id_order)->first();
    }
    #endregion
}
