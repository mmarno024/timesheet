<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_api_d3 extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = true;
    protected $hidden = [
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'trs_api_d3';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'd2_id',
        'kd_hardware',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function rel_kd_hardware()
    {
        return $this->belongsTo('App\Model\Trs\Local\Mst_hardware', 'kd_hardware', 'kd_hardware');
    }
}
