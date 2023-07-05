<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_log_activity_ews extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    public $incrementing = true;
    public $timestamps = true;
    protected $hidden = [
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'trs_log_activity_ews';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'ews_id',
        'sender',
        'send_direct',
        'send_type',
        'ews_tlocal',
        'ews_sirine_reply',
        'ews_sirine_level',
        'ews_location',
        'ews_latitude',
        'ews_longitude',
        'ews_gsm_signal',
        'ews_battery',
        'ews_temperature',
        'ews_door',
        'ews_message',
        'ews_parameter',
        'kd_hardware',
        'created_at',
        'deleted_at'
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }
    public function rel_ews_id()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_ews', 'ews_id', 'ews_id');
    }
    public function rel_kd_hardware()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_hardware', 'kd_hardware', 'kd_hardware');
    }
}
