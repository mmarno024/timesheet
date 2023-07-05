<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_raw_h extends Model
{

	use SoftDeletes;

	protected $connection = 'mysql';
	public $incrementing = true;
	public $timestamps = true;
	protected $hidden = ['deleted_at',];
	protected $dates = ['deleted_at'];
	protected $table = 'trs_raw_h';
	protected $primaryKey = "id";
	protected $fillable = [
		'id',
		'plant',
		'kd_logger',
		'kd_hardware',
		'uid',
		'location',
		'timestamp',
		'timeutc',
		'timelocal',
		'tlocal',
		'tzone',
		'tsample',
		'latitude',
		'longitude',
		'buka_pintu',
		'response',
		'sender',
		'browser',
		'secret_key',
		'parameter',
		'server',
		'dat_name',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function rel_created_by()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}
	public function rel_plant()
	{
		return $this->belongsTo('App\Model\Sys\Syplant', 'plant');
	}
	public function rel_kd_logger()
	{
		return $this->belongsTo('App\Model\Trs\Local\Mst_logger', 'kd_logger');
	}
	public function rel_d_gpa()
	{
		return $this->hasMany('App\Model\Trs\Local\Trs_raw_d_gpa', 'h_id', 'id');
	}
}
