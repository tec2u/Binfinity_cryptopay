<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyPercentage extends Model
{
    protected $table = 'daily_percentage';

    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'value_perc',
        'status'
    ];
}
