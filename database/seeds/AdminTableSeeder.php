<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('users')->insert(array(
		'first_name'=>'Ricardo',
		'last_name' =>'Uricoechea',	
		'email'=>'ur@gmail.com',
		'password'=>\Hash::make('urico'),
		'type'=> 'admin',
		'created_at' => new DateTime,   
         'updated_at' => new DateTime,
		// $this->call('UserTableSeeder');
	));

		\DB::table('user_profiles')->insert(array(
			'user_id'=>1,
			'birthdate'=>'1990/07/12',
			'created_at' => new DateTime,   
      	   'updated_at' => new DateTime,



			));
}
}
