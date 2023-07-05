<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users_api_is extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'users_api_is';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'users_api',
        'id_instansi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        'users_api',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function rel_id_instansi()
    {
        return $this->hasMany('App\Models\Ms_instansi', 'id_instansi', 'id_instansi');
    }
}
