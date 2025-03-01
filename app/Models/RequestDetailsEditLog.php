<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDetailsEditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'requests_details_id',
        'user_id',
        'flag',
        'request_id',
        'product_id',
        'status_id',
        'delivery_id',
        'warehouses_id',
        'warehouse_delivery_id',
        'amount',
        'location',
        'center_id',
        'worn',
        'worn_amount',
        'delivered',
        'has_remittance',
        'descriptions'
    ];
}
