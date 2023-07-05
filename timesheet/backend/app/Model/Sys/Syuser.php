<?php

namespace App\Model\Sys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Syuser extends Model
{

	use SoftDeletes;

	protected $connection = 'mysql';
	public $incrementing = false;
	public $timestamps = true;
	protected $hidden = [
		'password',
		'remember_token',
		'updated_at',
		'deleted_at',
	];
	protected $dates = ['deleted_at'];
	protected $table = 'syuser';
	protected $primaryKey = "userid";
	protected $fillable = [
		'userid',
		'username',
		'password',
		'email',
		'phone',
		'url_img',
		'url_sign',
		'gender',
		'address',
		'def_shift',
		'def_plant',
		'old_plant',
		'remember_token',
		'attr',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function rel_created_by()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}

	public function rel_def_plant()
	{
		return $this->belongsTo('App\Model\Sys\Syplant', 'def_plant', 'plant');
	}
}
