<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_service extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_service';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'konsumen',
        'lokasi_pos',
        'alamat',
        'nama_alat',
        'serial_no',
        'foot_mulai',
        'foot_selesai',
        'foot_ppic',
        'foot_ttd_ppic',
        'foot_pemeriksa',
        'foot_ttd_pemeriksa',
        'foot_nama_customer',
        'foot_jabatan_customer',
        'foot_ttd_customer',
        'foot_kualitas_pekerjaan',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
