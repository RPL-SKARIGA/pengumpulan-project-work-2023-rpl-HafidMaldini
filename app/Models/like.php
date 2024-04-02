<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;

    protected $table = 'like';

    public function jawaban()
    {
        $this->belongsTo(jawaban::class, 'id_jawaban');
    }
    public function user(){
        $this->belongsTo(user::class, 'id_user');
    }
}
