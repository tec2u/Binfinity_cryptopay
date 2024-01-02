<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    use HasFactory;
    protected $table = "items_order";

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'amount',
        'status'
    ];

    /**
     * Relacionamento de Tabelas
     */
    #region relacionamento

    public function order(){
        return $this->hasMany(Order::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
    #endregion
}
