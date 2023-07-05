<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_raw_d_gpa extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    public $incrementing = true;
    public $timestamps = true;
    protected $hidden = [
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'trs_raw_d_gpa';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'kd_hardware',
        'kd_sensor',
        'value',
        'value_rata2_or_harian',
        'value_aktual_or_sample',
        'level0',
        'level1',
        'level2',
        'level3',
        'level4',
        'level5',
        'alarm_status',
        'alarm_setting',
        'created_at',
        'deleted_at'
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }
    public function rel_sensor()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_sensor', 'kd_sensor', 'kd_sensor');
    }
}
