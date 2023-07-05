<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;

class Trs_log_activity_gpa extends Model
{
    protected $connection = 'mysql';
    public $incrementing = true;
    public $timestamps = true;
    protected $hidden = [
        'updated_at',
    ];
    protected $table = 'trs_log_activity_gpa';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'activity',
        'browser',
        'response',
        'secret_key',
        'time_exp',
        'created_by',
        'created_at',
        'updated_at',
    ];
}
