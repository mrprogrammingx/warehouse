<?php

namespace App\Models;

use App\Services\RequestsDetailsConfirmService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Request extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'status_id',
        'unit_id',
        'descriptions',
        'request_number',
        'validated_code',
        'confirmed'
    ];

    protected $hiden = ['validated_code'];

    protected $appends = ['confirmed'];

    public static function boot()
    {
        parent::boot();

        static::updated(function ($item) {
            //var_dump('test');die;
            Log::info('request updated!');
            //Event::fire('item.updated', $item);
        });
    }
    public function getConfirmedAttribute()
    {
        return (new RequestsDetailsConfirmService())->requestIsConfirmed($this->id);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request_detail()
    {
        return $this->hasMany(RequestDetail::class);
    }

    public function request_confirm()
    {
        return $this->hasMany(RequestsConfirm::class, 'request_id', 'id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Verta($value)->format('l d %B %Y H:i:s');
    }
}
