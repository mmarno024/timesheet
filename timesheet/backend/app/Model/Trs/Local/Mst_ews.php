<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_ews extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    protected $table = 'mst_ews';
    protected $primaryKey = 'ews_id';
    protected $fillable = [
        'ews_id',
        'sender',
        'send_direct',
        'send_type',
        'ews_tlocal',
        'ews_d1_tlocal',
        'ews_value',
        'ews_sirine',
        'ews_sirine_time',
        'ews_sirine_reply',
        'ews_sirine_reply_time',
        'ews_status',
        'ews_sirine_level',
        'ews_location',
        'ews_latitude',
        'ews_longitude',
        'ews_gsm_signal',
        'ews_battery',
        'ews_temperature',
        'ews_door',
        'ews_gsm',
        'ews_message',
        'kd_hardware',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function rel_kd_hardware()
    {
        return $this->belongsTo(
            'App\Model\Trs\Local\Mst_hardware',
            'kd_hardware',
            'kd_hardware'
        );
    }
}
