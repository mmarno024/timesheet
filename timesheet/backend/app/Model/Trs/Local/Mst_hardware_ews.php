<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_hardware_ews extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = true;
    public $timestamps = true;
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    protected $table = 'mst_hardware_ews';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kd_hardware',
        'ews_id',
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
    public function rel_ews()
    {
        return $this->belongsTo(
            'App\Model\Trs\Local\Mst_ews',
            'ews_id',
            'ews_id'
        );
    }
}
