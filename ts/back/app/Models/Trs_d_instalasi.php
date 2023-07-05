<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_instalasi extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_instalasi';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'konsumen',
        'nama_alat',
        'nama_pos',
        'no_hp_pos',
        'kabupaten',
        'kecamatan',
        'latitude',
        'longitude',
        'foot_mulai',
        'foot_selesai',
        'foot_instansi_customer',
        'foot_nama_customer',
        'foot_jabatan_customer',
        'foot_teknisi1',
        'foot_ttd_teknisi1',
        'foot_teknisi2',
        'foot_ttd_teknisi2',
        'foot_ttd_customer',
        'foot_kualitas_pekerjaan',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
