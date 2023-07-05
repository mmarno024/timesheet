<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_service_action extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_service_action';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'call',
        'warranty',
        'maintenance',
        'installation',
        'training',
        'delivery',
        'demo',
        'spare_part',
        'repeat_service',
        'routine_check',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
