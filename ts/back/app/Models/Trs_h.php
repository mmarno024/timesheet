<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_h extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_h';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'jenis_ts',
        'kd_ts',
        'userid',
        'tanggal_ts',
        'customer',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];

    public function rel_userid()
    {
        return $this->belongsTo('App\Models\User', 'userid', 'id');
    }
    public function rel_d_timesheet()
    {
        return $this->hasMany('App\Models\Trs_d_timesheet', 'h_id', 'id');
    }
    public function rel_d_timesheet_img0()
    {
        return $this->hasMany('App\Models\Trs_d_timesheet_img0', 'h_id', 'id');
    }
    public function rel_d_timesheet_img25()
    {
        return $this->hasMany('App\Models\Trs_d_timesheet_img25', 'h_id', 'id');
    }
    public function rel_d_timesheet_img50()
    {
        return $this->hasMany('App\Models\Trs_d_timesheet_img50', 'h_id', 'id');
    }
    public function rel_d_timesheet_img75()
    {
        return $this->hasMany('App\Models\Trs_d_timesheet_img75', 'h_id', 'id');
    }
    public function rel_d_timesheet_img100()
    {
        return $this->hasMany('App\Models\Trs_d_timesheet_img100', 'h_id', 'id');
    }
    public function rel_d_timesheet_imgx()
    {
        return $this->hasMany('App\Models\Trs_d_timesheet_imgx', 'h_id', 'id');
    }
    // public function rel_d_instalasi()
    // {
    //     return $this->hasMany('App\Models\Trs_d_instalasi', 'h_id', 'id');
    // }
    // public function rel_d_instalasi_note()
    // {
    //     return $this->hasMany('App\Models\Trs_d_instalasi_note', 'h_id', 'id');
    // }
    // public function rel_d_instalasi_sending()
    // {
    //     return $this->hasMany('App\Models\Trs_d_instalasi_sending', 'h_id', 'id');
    // }
    // public function rel_d_instalasi_sensor_pasang()
    // {
    //     return $this->hasMany('App\Models\Trs_d_instalasi_sensor_pasang', 'h_id', 'id');
    // }
    // public function rel_d_instalasi_setup_setting()
    // {
    //     return $this->hasMany('App\Models\Trs_d_instalasi_setup_setting', 'h_id', 'id');
    // }

    // public function rel_d_service()
    // {
    //     return $this->hasMany('App\Models\Trs_d_service', 'h_id', 'id');
    // }
    // public function rel_d_service_action()
    // {
    //     return $this->hasMany('App\Models\Trs_d_service_action', 'h_id', 'id');
    // }
    // public function rel_d_service_investigasi()
    // {
    //     return $this->hasMany('App\Models\Trs_d_service_investigasi', 'h_id', 'id');
    // }
    // public function rel_d_service_kategori()
    // {
    //     return $this->hasMany('App\Models\Trs_d_service_kategori', 'h_id', 'id');
    // }
    // public function rel_d_service_note()
    // {
    //     return $this->hasMany('App\Models\Trs_d_service_note', 'h_id', 'id');
    // }
    // public function rel_d_service_pekerjaan()
    // {
    //     return $this->hasMany('App\Models\Trs_d_service_pekerjaan', 'h_id', 'id');
    // }
    // public function rel_d_service_problem()
    // {
    //     return $this->hasMany('App\Models\Trs_d_service_problem', 'h_id', 'id');
    // }
    // public function rel_d_service_spare_part()
    // {
    //     return $this->hasMany('App\Models\Trs_d_service_spare_part', 'h_id', 'id');
    // }
    // public function rel_d_service_stock_from()
    // {
    //     return $this->hasMany('App\Models\Trs_d_service_stock_from', 'h_id', 'id');
    // }

    // public function rel_d_img()
    // {
    //     return $this->hasMany('App\Models\Trs_d_image', 'h_id', 'id');
    // }
}
