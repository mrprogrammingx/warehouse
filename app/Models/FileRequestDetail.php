<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileRequestDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_id',
        'request_detail_id',
    ];
    protected $table = 'file_request_details';

    public function requestDetail()
    {
        return $this->belongsTo(RequestDetail::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

}
