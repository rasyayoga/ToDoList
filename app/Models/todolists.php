<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todolists extends Model
{
    use HasFactory;
    // ke tabel mana clas ini akan tertuju, yaitu tabel yang bernama todolists
    protected $table = "todolists"; 
    // field yang bisa diisi/wajib diisi
    protected $fillable = [
        "task",
        "is_done",
        "user_id"
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
