<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users_api extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'users_api';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'user',
        'name',
        'password',
        'user_code',
        'token',
        'status',
        'expired_date',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        'id ',
        'password',
        'token',
        'ip_address',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function rel_is()
    {
        return $this->hasMany('App\Models\Users_api_is', 'users_api', 'id');
    }

    public function rel_ip()
    {
        return $this->hasMany('App\Models\Users_api_ip', 'users_api', 'id');
    }

    public function rel_hw()
    {
        return $this->hasMany('App\Models\Users_api_hw', 'users_api', 'id');
    }
}
