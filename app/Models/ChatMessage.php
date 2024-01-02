<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $table = 'chat_message';

    protected $fillable = [
        'id',
        'message_id',
        'user_name',
        'title',
        'text',
        'date',
        'status'
    ];

    /*
    Relacionamento de Tabelas
    */

    #region
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function chat()
    {
        return $this->hasMany(Chat::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
    #endregion

}
