<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesConfirm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'confirm_id',
        'category_id',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function confirm(){
        return $this->belongsTo(Confirm::class);
    }
}
