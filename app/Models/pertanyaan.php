<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan'; 

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo(user::class, 'id_user');
    }

    public function kategori() {
        return $this->belongsto(kategori::class, 'id_kategori');
    }

    public function likes()
{
    return $this->hasMany(Like::class);
}

public function incrementLikesCount()
{
    $this->increment('likes_count');
}

public function decrementLikesCount()
{
    $this->decrement('likes_count');
}

public function jawaban(){
    $this->hasMany(jawaban::class);
}

public function report(){
    $this->hasMany(report::class);
}

}
