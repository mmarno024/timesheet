<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_api_d1 extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = [
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'trs_api_d1';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'ip_address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
