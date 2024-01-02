<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemConf extends Model
{
   use HasFactory;

   protected $table = 'system_conf';

   protected $fillable = [
      'is_allowed_btn_box',
   ];

}
