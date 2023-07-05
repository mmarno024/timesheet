<?php

namespace App\Model\Sys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Syaccess extends Model
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
	protected $table = 'syaccess';
	protected $primaryKey = "accessid";
	protected $fillable = [
		'accessid',
		'accessname',
		'accessgroup',
		'location',
		'note',
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
