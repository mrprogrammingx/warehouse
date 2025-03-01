<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuysConfirm extends Model
{
    use HasFactory;

    protected $fillable = [
        'buys_detail_id',
        'confirm_id',
        'user_id',
        'confirmed'
    ];
}
