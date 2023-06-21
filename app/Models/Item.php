<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'quantity',
        'unit',
        'price',
        'image'
    ];

    public function status()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
