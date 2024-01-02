<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentageHistory extends Model
{
   
    protected $table = 'percentage_history';

    public $timestamps = false;
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'value_perc',
        'created_at'
    ];
}
