<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_service_spare_part extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_service_spare_part';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'part_number',
        'spare_part',
        'qty',
        'sf',
        'sn',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
