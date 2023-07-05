<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_timesheet_img75 extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_timesheet_img75';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'foto',
        'path',
        'ext',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
    public function setFotoAttribute($value)
    {
        $this->attributes['foto'] = json_encode($value);
    }
}
