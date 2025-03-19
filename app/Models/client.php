<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class client extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'prenom', 'email', 'password', 'role',];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }

     // Verfier si le client est un admin.
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
