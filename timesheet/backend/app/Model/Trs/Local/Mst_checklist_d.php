<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_checklist_d extends Model
{

	use SoftDeletes;

	protected $connection = 'mysql';
	public $incrementing = true;
	public $timestamps = true;
	protected $hidden = [
		'updated_at',
		'deleted_at',
	];
	protected $dates = ['deleted_at'];
	protected $table = 'mst_checklist_d';
	protected $primaryKey = "id";
	protected $fillable = [
		'id',
		'kd_checklist',
		'kd_detail',
		'nm_detail',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function rel_created_by()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}
}
