<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// $this->call(UsersTableSeeder::class);
		/*DB::table('users')->insert([
			'name' => 'admin',
			'email' => 'admin@gmail.com',
			'password' => bcrypt('secret'),
		]);*/
		DB::table('users')->insert([
			'name' => 'fantasi',
			'email' => 'fantasi@gmail.com',
			'password' => bcrypt('xxx'),
		]);
	}
}
