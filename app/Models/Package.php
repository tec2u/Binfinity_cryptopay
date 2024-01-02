<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'img',
        'activated',
        'commission',
        'long_description',
        'type',
        'description_fees',
        'plan_id'
    ];

    /**
     * Relacionamentos de Tabelas
     */
    #region relacionamento
    public function orderPackage()
    {
        return $this->hasMany(OrderPackage::class);
    }
    #endregion
    /** */

    // public function packageTotal($packageid){

    //     $value = TokenValue::find(1)->value_usd;

    //     $package = Package::where('id', '=', $packageid)
    //     ->selectRaw("sum(period_days*daily_returns*$value) as total")
    //     ->first();
      
    //     return $package->total;
    // }
}
