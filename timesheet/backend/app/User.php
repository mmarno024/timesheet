<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract {
	use Notifiable;
	use Authenticatable;

	public $incrementing = false;
	protected $table = 'syuser';
	protected $primaryKey = "userid";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
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
		'remember_token',
		'attr',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
}
