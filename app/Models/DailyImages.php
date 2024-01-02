<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyImages extends Model
{
    use HasFactory;

    protected $table = 'dailyimages';

    protected $fillable = [
        'title', 'path'
    ];
}
