<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveDateBonusDaily extends Model
{
    use HasFactory;

    protected $table = 'save_date_bonus_daily';

    protected $fillable = [
        'id',
        'amount_paid',
        'date_paid'
    ];
}
