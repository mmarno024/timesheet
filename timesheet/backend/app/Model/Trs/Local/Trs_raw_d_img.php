<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_raw_d_img extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = true;
    public $timestamps = true;
    protected $hidden = [
        'created_by',
        'updated_at',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'trs_raw_d_img';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'tlocal',
        'kd_logger',
        'kd_hardware',
        'uid',
        'timestamp',
        'tzone',
        'timeutc',
        'img_name',
        'date_capture',
        'date_in',
        'latitude',
        'longitude',
        'location',
        'sender',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }
    public function rel_kd_logger()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_logger', 'kd_logger', 'kd_logger');
    }
    public function rel_kd_hardware()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_hardware', 'kd_hardware', 'kd_hardware');
    }
}
