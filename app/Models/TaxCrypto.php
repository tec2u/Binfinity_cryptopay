<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCrypto extends Model
{
    use HasFactory;

    // Definindo o nome da tabela, caso não seja o plural do nome do modelo
    protected $table = 'tax_crypto';

    // Atribuição em massa (mass assignment) - Defina os campos que podem ser preenchidos
    protected $fillable = [
        'user_id',
        'coin',
        'tx_bin',
        'tx_gas',
        'verification_margin_dol'
    ];

    public $availableCryptos = [
        'BITCOIN',
        'TRX',
        'ETH',
        'USDT_TRC20',
        'USDT_ERC20',
        'SOL',
        'BNB'
    ];

    // Relação com o model User (Assumindo que a tabela 'users' já tem a relação definida)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createDefaultTax($user)
    {
        foreach ($this->availableCryptos as $key => $value) {
            $exists = $this::where("user_id", $user)->where("coin", $value)->first();
            if (!isset($exists)) {
                $tax = new TaxCrypto();
                $tax->user_id = $user;
                $tax->coin = $value;
                $tax->tx_bin = 1;
                $tax->tx_gas = 4;
                $tax->verification_margin_dol = 15;
                $tax->save();
            }
        }
    }
}
