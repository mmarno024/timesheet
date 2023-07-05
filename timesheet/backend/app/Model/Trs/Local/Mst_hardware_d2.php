<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_hardware_d2 extends Model
{

    use SoftDeletes;

    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = false;
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'mst_hardware_d2';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'kd_hardware',
        'kd_sensor',
        'count_step',
        'val_step',
        'color_step',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function rel_created_by()
    {
        return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
    }
}
