<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_service_pekerjaan extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_service_pekerjaan';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'ganti_part_modul',
        'setting_kalibrasi',
        'modification_upgrade',
        'maintenance',
        'installasi',
        'training',
        'pengiriman',
        'observasi',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
