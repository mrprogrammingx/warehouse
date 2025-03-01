<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];
    
    public function request(){
        return $this->hasMany(Request::class);
    }

    public function usersUnit()
    {
        return $this->hasMany(UsersUnit::class);
    }
}
