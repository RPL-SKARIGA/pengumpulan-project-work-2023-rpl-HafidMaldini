<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(user::class, 'id_user');
    }

    // Relasi ke model Post (posting)
    public function pertanyaan()
    {
        return $this->belongsTo(pertanyaan::class, 'id_soal');
    }
    // app/Post.php
    public function likes()
{
    return $this->hasMany(Like::class);
}

public function incrementLikesCount()
{
    $this->increment('like_count');
}

public function decrementLikesCount()
{
    $this->decrement('like_count');
}

public function OrderByLikes($query)
    {
        return $query->orderBy('like_count', 'desc');
    }
 
}
