<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function requests_confirm(){
        return $this->hasMany(RequestsConfirm::class,'confirm_id','id');
    }

    public function requests_details_confirm(){
        return $this->hasMany(RequestsDetailsConfirm::class,'confirm_id','id');
    }

    public function usersConfirm(){
        return $this->hasMany(UsersConfirm::class);
    }

    public function getUpdatedAtAttribute($value)
    {
        return Verta($value)->format('l d %B %Y H:i:s');
    }

    public function productsConfirm(){
        return $this->hasMany(ProductsConfirm::class);
    }

    public function categoriesConfirm(){
        return $this->hasMany(CategoriesConfirm::class);
    }
}
