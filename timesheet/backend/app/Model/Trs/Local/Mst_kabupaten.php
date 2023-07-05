<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_kabupaten extends Model
{

	use SoftDeletes;

	protected $connection = 'mysql';
	public $incrementing = false;
	public $timestamps = false;
	protected $hidden = [
		'updated_at',
		'deleted_at',
	];
	protected $dates = ['deleted_at'];
	protected $table = 'mst_kabupaten';
	protected $primaryKey = "kd_kabupaten";
	protected $fillable = [
		'kd_kabupaten',
		'kd_provinsi',
		'nm_kabupaten',
	];

	public function rel_created_by()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}
}
