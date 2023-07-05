<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_instalasi_sending extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_instalasi_sending';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'status_setup_server1',
        'status_setup_server2',
        'status_setup_server3',
        'address1',
        'address2',
        'address3',
        'username1',
        'username2',
        'username3',
        'password1',
        'password2',
        'password3',
        'interval_data1',
        'interval_data2',
        'interval_data3',
        'status_photo_web1',
        'status_photo_web2',
        'status_photo_web3',
        'interval_photo1',
        'interval_photo2',
        'interval_photo3',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
