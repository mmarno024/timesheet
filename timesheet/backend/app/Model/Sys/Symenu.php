<?php

namespace App\Model\Sys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Symenu extends Model
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
	protected $table = 'symenu';
	protected $primaryKey = "menu_id";
	protected $fillable = [
		'menu_id',
		'label',
		'url',
		'redirect',
		'parent',
		'icon',
		'note',
		'order_no',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function rel_created_by()
	{
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}

	public function rel_parent()
	{
		return $this->belongsTo('App\Model\Sys\Symenu', 'parent', 'menu_id');
	}

	public function rel_symenu()
	{
		return $this->hasMany('App\Model\Sys\Symenu', 'parent', 'menu_id');
	}
}
