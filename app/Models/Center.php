<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    public function request_detail()
    {
        return $this->hasMany(RequestDetail::class,'center_id','id');
    }
}
