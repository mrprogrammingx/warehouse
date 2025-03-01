<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersConfirm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'confirm_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function confirm(){
        return $this->belongsTo(Confirm::class);
    }
}
