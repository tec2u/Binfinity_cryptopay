<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
   use HasFactory;

   protected $table = 'career';

   protected $fillable = [
      'name',
      'directs',
      'score',
      'bonus',
      'pin',
      'activated',
      'levels',
   ];

   /**
     * Relacionamentos de Tabelas
     */
   #region relacionamento
   public function career_user()
   {
      return $this->hasMany(CareerUser::class);
   }
   #endregion
}
