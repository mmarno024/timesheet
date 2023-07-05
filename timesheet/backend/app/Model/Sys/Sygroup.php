<?php

namespace App\Model\Sys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sygroup extends Model
{

	use SoftDeletes;

	// protected $connection = '';
	public $incrementing = false;
	public $timestamps = false;
	protected $hidden = [
		'updated_at',
		'deleted_at',
	];
	protected $dates = ['deleted_at'];
	protected $table = 'sygroup';
	protected $primaryKey = "group_id";
	protected $fillable = [
		'group_id',
		'group_name',
		'note',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];
}
