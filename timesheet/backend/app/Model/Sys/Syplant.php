<?php

namespace App\Model\Sys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Syplant extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing  = false;
    public $timestamps    = true;
    protected $hidden     = [
        'com_code',
        'bus_area',
        'updated_at',
        'deleted_at',
    ];
    protected $dates      = ['deleted_at'];
    protected $table      = 'syplant';
    protected $primaryKey = "plant";
    protected $fillable   = [
        'plant',
        'plantname',
        'com_code',
        'bus_area',
        'old_plant',
        'addr',
        'city',
        'provice',
        'state',
        'postcode',
        'area',
        'coordinate',
        'url_file',
        'note',
        'favicon',
        'image',
        'image_favicon',
        'year',
        'latitude',
        'longitude',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }

    public function rel_com_code()
    {
        return $this->belongsTo('App\Model\Sys\Sycom', 'com_code');
    }

    public function rel_provice()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_provinsi', 'provice', 'kd_provinsi');
    }

    public function rel_city()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_kabupaten', 'city', 'kd_kabupaten');
    }

    public function rel_district()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_kecamatan', 'state', 'kd_kecamatan');
    }
}
