<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'priority',
        'description',
    ];

    protected $table = 'statuses';

    public function request_detail(){
        return $this->belongsTo(RequestDetail::class,'status_id','id');
    }
    
}
