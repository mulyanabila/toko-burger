<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Product extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    public function items()
{
    return $this->hasMany(OrderItem::class);
}
}
