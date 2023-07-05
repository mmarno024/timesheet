<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_instalasi_sensor_pasang extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_instalasi_sensor_pasang';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'nama',
        'sn',
        'spek_rentang_ukur',
        'nilai_kalibrasi',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
