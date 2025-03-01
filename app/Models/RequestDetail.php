<?php

namespace App\Models;

use App\Services\RequestsDetailsConfirmService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDetail extends Model
{
    use HasFactory;

    protected $table = 'requests_details';
    protected $fillable = [
        'id',
        'request_id',
        'old_request_id',
        'changed_product',
        'product_id',
        'status_id',
        'delivery_id',
        'warehouses_id',
        'warehouse_delivery_id',
        'amount',
        'location',
        'center_id',
        'item_consumption_type_id',
        'center3_id',
        'return_delivery_id',
        'return_user_id',
        'returned',
        'edited',
        'not_exist',
        'worn',
        'worn_amount',
        'delivered',
        'has_remittance',
        'descriptions',
    ];

    protected $appends = ['confirmed'];

    public function getConfirmedAttribute()
    {
        return (new RequestsDetailsConfirmService())->requestDetailIsConfirmed($this->id);
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function file()
    {
        return $this->hasMany(File::class, 'id', 'file_id');
    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class, 'id', 'delivery_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouses_id', 'id');
    }

    public function request_detail_confirm()
    {
        return $this->hasMany(RequestsDetailsConfirm::class, 'requests_detail_id', 'id');
    }

    public function fileRequestDetail()
    {
        return $this->hasMany(FileRequestDetail::class);
    }

    public function getUpdatedAtAttribute($value)
    {
        return Verta($value)->format('l d %B %Y H:i:s');
    }

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id', 'id');
    }
}
