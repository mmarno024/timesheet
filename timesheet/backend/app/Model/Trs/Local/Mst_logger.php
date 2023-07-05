<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_logger extends Model
{

	use SoftDeletes;

	protected $connection = 'mysql';
	public $incrementing = false;
	public $timestamps = true;
	protected $hidden = [
		'updated_at',
		'deleted_at',
	];
	protected $dates = ['deleted_at'];
	protected $table = 'mst_logger';
	protected $primaryKey = "kd_logger";
	protected $fillable = [
		'kd_logger',
		'nm_logger',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function rel_created_by()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}

	public function rel_hardware()
	{
		return $this->hasMany('App\Model\Trs\Local\Mst_hardware', 'kd_logger', 'kd_logger');
	}
}
