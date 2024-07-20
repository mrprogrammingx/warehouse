<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuysDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'buy_id',
        'product_id',
        'status_id',
        'file_id',
        'delivery_id',
        'amount',
        'worn',
        'confirmed',
        'descriptions',
    ];
}
