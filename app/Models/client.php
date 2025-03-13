<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class client extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'prenom', 'email', 'password'];

    protected $hidden = ['password'];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
