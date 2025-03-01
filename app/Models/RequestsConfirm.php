<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestsConfirm extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'confirm_id',
        'user_id',
        'confirmed',
    ];

    public function request(){
        return $this->belongsTo(Request::class,'id', 'request_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function confirm(){
        return $this->belongsTo(Confirm::class,'confirm_id','id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Verta($value)->format('l d %B %Y H:i:s');
    }
}
