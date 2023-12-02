<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $guarded = ['id'];

    public function pertanyaan(){
        return $this->hasMany(pertanyaan::class);
    }
}
