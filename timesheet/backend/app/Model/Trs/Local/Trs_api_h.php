<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_api_h extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'trs_api_h';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'username',
        'password',
        'fullname',
        'user_code',
        'token',
        'filter_ip',
        'filter_plant',
        'filter_hardware',
        'status',
        'expired_date',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }
    public function rel_d1()
    {
        return $this->hasMany('App\Model\Trs\Local\Trs_api_d1', 'h_id', 'id');
    }
    public function rel_d2()
    {
        return $this->hasMany('App\Model\Trs\Local\Trs_api_d2', 'h_id', 'id');
    }
    public function rel_d3()
    {
        return $this->hasMany('App\Model\Trs\Local\Trs_api_d3', 'h_id', 'id');
    }
}
