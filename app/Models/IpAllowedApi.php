<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpAllowedApi extends Model
{
    use HasFactory;

    protected $table = 'ip_allowed_api';

    protected $fillable = [
        'ip',
        'user_id',
    ];

    // Relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
