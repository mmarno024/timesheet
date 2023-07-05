<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_service_problem extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_service_problem';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'problem1',
        'problem2',
        'problem3',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
