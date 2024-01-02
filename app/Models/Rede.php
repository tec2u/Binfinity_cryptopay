<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rede extends Model
{
    use HasFactory;

    protected $table = 'rede';

    protected $fillable = [
        'user_id',
        'upline_id',
        'ciclo',
        'qty',
        'saque'
    ];

    /**
    * Relacionamento de Tabelas
    */
    #region relacionamento
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // public function upline() {
    //     return $this->hasMany(rede::class,'id');
    // }
    #endregion

    public function getTypeActivated($id)
    {
        $rede = $this::find($id);
        
        $pay = OrderPackage::where('user_id', $rede->user->id)->where('status', 1)->where('payment_status', 1)->first();
        
        $getadessao = $rede->user->getAdessao($rede->user->id);

        $getpackages = $rede->user->getPackages($rede->user->id);

        if(!$pay){
            $tag = "Inactive";
        }
        if($getadessao > 0){
            $tag = "PreRegistration";
        }
        if($getpackages > 0){
            $tag = "AllCards";
        }
        
        return $tag;
    }

    public function getReferal($id)
    {
        $rede = Rede::where('upline_id', $id)->get();
        return $rede;
    }

    public function getReferalName($id)
    {
        $rede =  $this::find($id);
        return $rede->user->name;
    }
}
