<?php

namespace App\Model\Sys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sylink extends Model
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
	protected $table = 'sylink';
	protected $primaryKey = "id";
	protected $fillable = [
		'id',
		'rel',
		'key1',
		'key2',
		'key3',
		'key4',
		'key5',
		'tbl1',
		'tbl2',
		'tbl3',
		'tbl4',
		'tbl5',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function rel_created_by()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}

	public function rel_key1_group()
	{
		return $this->belongsTo('App\Model\Sys\Sygroup', 'key1', 'group_id');
	}

	public function rel_key1_user()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'key1', 'userid');
	}

	public function rel_key2_plant()
	{
		return $this->belongsTo('App\Model\Sys\Syplant', 'key2', 'plant');
	}

	public function rel_key2_group()
	{
		return $this->belongsTo('App\Model\Sys\Sygroup', 'key2', 'group_id');
	}

	public function rel_key2_access()
	{
		return $this->belongsTo('App\Model\Sys\Syaccess', 'key2', 'accessid');
	}

	public function rel_key2_menu()
	{
		return $this->belongsTo('App\Model\Sys\Symenu', 'key2', 'menu_id');
	}
}
