<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_service_kategori extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_service_kategori';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'mekanikal',
        'elektrikal',
        'sensor',
        'software',
        'power_supplay',
        'logger',
        'kelengkapan',
        'modem',
        'accessories',
        'human_error',
        'other',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
