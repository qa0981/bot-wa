<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'wa_id',
        'sender',
        'message',
        'direction',
        'handled_by'
    ];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}