<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_service_stock_from extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_service_stock_from';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'main_store',
        'logistik',
        'customer',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
