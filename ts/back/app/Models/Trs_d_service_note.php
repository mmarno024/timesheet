<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_service_note extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_service_note';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'note1',
        'note2',
        'note3',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
