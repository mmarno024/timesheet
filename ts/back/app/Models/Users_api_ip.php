<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users_api_ip extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'users_api_ip';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'users_api',
        'ip_address',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        // 'users_api',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
