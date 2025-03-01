<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsConfirm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'confirm_id',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function confirm(){
        return $this->belongsTo(Confirm::class);
    }
}
