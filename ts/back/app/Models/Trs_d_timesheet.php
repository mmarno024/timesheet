<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_timesheet extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_timesheet';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'form_lk',
        'path_lk',
        'ext_lk',
        'form_instal_service',
        'path_instal_service',
        'ext_instal_service',
        'form_checklist',
        'path_checklist',
        'ext_checklist',
        'note',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
    public function setForm_lkAttribute($value)
    {
        $this->attributes['form_lk'] = json_encode($value);
    }
    public function setForm_instal_serviceAttribute($value)
    {
        $this->attributes['form_instal_service'] = json_encode($value);
    }
    public function setForm_checklistAttribute($value)
    {
        $this->attributes['form_checklist'] = json_encode($value);
    }
}
