<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'resume',
        'description',
        'img_1',
        'img_2',
        'type',
        'unity',
        'price',
        'height',
        'width',
        'depth',
        'weight',
        'amount',
        'score',
        'slug',
        'activated',
    ];

}
