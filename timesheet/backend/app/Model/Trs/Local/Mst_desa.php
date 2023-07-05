<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_desa extends Model
{

	use SoftDeletes;

	protected $connection = 'mysql';
	public $incrementing = false;
	public $timestamps = false;
	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	protected $dates = ['deleted_at'];
	protected $table = 'mst_desa';
	protected $primaryKey = "kd_desa";
	protected $fillable = [
		'kd_desa',
		'kd_kecamatan',
		'nm_desa',
	];

	public function rel_created_by()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}
}
