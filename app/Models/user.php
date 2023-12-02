<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class user extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;

    protected $table = 'user';

    protected $guarded = ['id', 'created_at', 'role','updated_at'];

    public function findForPassport($username) {
        return $this->where('email', $username)->orWhere('username', $username)->first();
    }
    public function likes()
{
    return $this->hasMany(Like::class);
}
    public function isAdmin()
{
    return $this->role === 'admin';
}

}
