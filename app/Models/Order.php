<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'total_price', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products() 
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }
}
