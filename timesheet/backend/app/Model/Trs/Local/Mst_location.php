<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_location extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = [
        'plant',
        'updated_at',
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'mst_location';
    protected $primaryKey = "kd_location";
    protected $fillable = [
        'kd_location',
        'location',
        'kd_provinsi',
        'kd_kabupaten',
        'kd_kecamatan',
        'kd_desa',
        'plant',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }

    public function rel_provinsi()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_provinsi', 'kd_provinsi', 'kd_provinsi');
    }

    public function rel_kabupaten()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_kabupaten', 'kd_kabupaten', 'kd_kabupaten');
    }

    public function rel_kecamatan()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_kecamatan', 'kd_kecamatan', 'kd_kecamatan');
    }
}
