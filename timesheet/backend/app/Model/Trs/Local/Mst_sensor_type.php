<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_sensor_type extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'mst_sensor_type';
    protected $primaryKey = "kd_type";
    protected $fillable = [
        'kd_type',
        'type',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }

    public function rel_d1()
    {
        return $this->hasMany('App\Model\Trs\Local\Mst_sensor', 'kd_type', 'kd_type');
    }
}
