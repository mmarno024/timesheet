<?php

namespace App\Model\Trs\Local;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mst_checklist extends Model
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
	protected $table = 'mst_checklist';
	protected $primaryKey = "kd_checklist";
	protected $fillable = [
		'kd_ct',
		'kd_checklist',
		'nm_checklist',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function rel_created_by()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}
	public function rel_kd_ct()
	{
		return $this->belongsTo('App\Model\Trs\Local\Mst_checklist_type', 'kd_ct', 'kd_ct');
	}
	public function rel_d()
	{
		return $this->hasMany('App\Model\Trs\Local\Mst_checklist_d', 'kd_checklist', 'kd_checklist');
	}
}
