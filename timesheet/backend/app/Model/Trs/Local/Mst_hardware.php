<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_hardware extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    protected $table = 'mst_hardware';
    protected $primaryKey = 'kd_hardware';
    protected $fillable = [
        'kd_logger',
        'versi_data_logger',
        'kd_hardware',
        'uid',
        'tlocal',
        'tzone',
        'tsample',
        'latitude',
        'longitude',
        'location',
        'pos_name',
        'perkalian',
        'penjumlahan',
        'satuan',
        'no_gsm',
        'kd_provinsi',
        'kd_kabupaten',
        'kd_kecamatan',
        'kd_desa',
        'type',
        'plant',
        'buka_pintu',
        'condition',
        'set_alarm',
        'view_map',
        'view_expired',
        'created_by',
        'send_interval',
        'reset_interval',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_at',
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }
    
    public function rel_plant()
    {
        return $this->belongsTo('App\Model\Sys\Syplant', 'plant', 'plant');
    }

    public function rel_kd_logger()
    {
        return $this->belongsTo(
            'App\Model\Trs\Local\Mst_logger',
            'kd_logger',
            'kd_logger'
        );
    }

    public function rel_d1()
    {
        return $this->hasMany(
            'App\Model\Trs\Local\Mst_hardware_d1',
            'kd_hardware',
            'kd_hardware'
        );
    }

    public function rel_d2()
    {
        return $this->hasMany(
            'App\Model\Trs\Local\Mst_hardware_d2',
            'kd_hardware',
            'kd_hardware'
        );
    }

    public function rel_d3_ews()
    {
        return $this->hasMany(
            'App\Model\Trs\Local\Mst_hardware_ews',
            'kd_hardware',
            'kd_hardware'
        );
    }

    public function rel_location()
    {
        return $this->belongsTo(
            'App\Model\Trs\Local\Mst_location',
            'location',
            'location'
        );
    }

    public function rel_provinsi()
    {
        return $this->belongsTo(
            'App\Model\Trs\Local\Mst_provinsi',
            'kd_provinsi',
            'kd_provinsi'
        );
    }

    public function rel_kabupaten()
    {
        return $this->belongsTo(
            'App\Model\Trs\Local\Mst_kabupaten',
            'kd_kabupaten',
            'kd_kabupaten'
        );
    }

    public function rel_kecamatan()
    {
        return $this->belongsTo(
            'App\Model\Trs\Local\Mst_kecamatan',
            'kd_kecamatan',
            'kd_kecamatan'
        );
    }

    public function rel_desa()
    {
        return $this->belongsTo(
            'App\Model\Trs\Local\Mst_desa',
            'kd_desa',
            'kd_desa'
        );
    }
}
