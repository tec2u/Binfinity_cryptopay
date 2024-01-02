<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StakingRewards extends Model
{
   use HasFactory;

   protected $table = 'historic_score';

   protected $fillable = [
      'user_id',
      'order_id',
      'description',
      'score',
      'status'
   ];

   /**
    * Relacionamentos de Tabelas
    */
   #region relacionamento
   public function user()
   {
      return $this->hasMany(User::class);
   }

   public function order()
   {
      return $this->hasMany(Order::class);
   }

   public function career()
   {
      return $this->hasMany(Career::class);
   }
   #endregion
}
