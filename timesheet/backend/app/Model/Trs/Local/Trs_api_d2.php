<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_api_d2 extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = [
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'trs_api_d2';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'plant',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function rel_plant()
    {
        return $this->belongsTo('App\Model\Sys\Syplant', 'plant', 'plant');
    }
    public function rel_d3()
    {
        return $this->hasMany('App\Model\Trs\Local\Trs_api_d3', 'd2_id', 'id');
    }
}
