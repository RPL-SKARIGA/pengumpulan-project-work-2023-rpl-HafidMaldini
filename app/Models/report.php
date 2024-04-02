<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    use HasFactory;

    protected $table = 'report';

    protected $guarded = ['id'];

    public function user(){
       return $this->belongsTo( user::class, 'id_user');
    }

    public function pertanyaan(){
       return $this->belongsTo( pertanyaan::class, 'id_soal');
    }
}
