<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_hardware_d1 extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = false;
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    protected $table = 'mst_hardware_d1';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kd_hardware',
        'kd_sensor',
        'value',
        'value_rata2_or_harian',
        'value_aktual_or_sample',
        'val_min',
        'val_max',
        'val_count',
        'val_total',
        'val_cum',
        'val_date',
        'level0',
        'level1',
        'level2',
        'level3',
        'level4',
        'level5',
        'alarm_status',
        'alarm_setting',
        'alarm_flag',
        'btn_status',
        'btn_type',
        'actual_device',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }
    public function rel_sensor()
    {
        return $this->belongsTo(
            'App\Model\Trs\Local\Mst_sensor',
            'kd_sensor',
            'kd_sensor'
        );
    }
}
