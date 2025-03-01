<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RequestsDetailsConfirm extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'requests_detail_id',
        'confirm_id',
        'user_id',
        'confirmed',
        'description',
    ];

    public function request_details(){
        return $this->belongsTo(RequestDetail::class, 'requests_detail_id', 'id');
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
