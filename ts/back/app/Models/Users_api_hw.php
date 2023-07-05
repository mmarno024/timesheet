<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users_api_hw extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'users_api_hw';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'users_api',
        'hardware',
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

    public function rel_users_api()
    {
        return $this->belongsTo('App\Models\Users_api', 'users_api', 'id');
    }
}
