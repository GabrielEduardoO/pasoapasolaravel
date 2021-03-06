<?php namespace App\Services;
use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
class Registrar implements RegistrarContract {
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
            'user_name' => 'required|max:255|unique:users,user_name',
           	'email' => 'required|email|max:255|unique:users,email',
			'password' => 'required|confirmed|min:6',
			'type' => 'required|max:255',

		]);
	}
	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
            'user_name' => $data['user_name'],
           	'email' => $data['email'],
			'type'  => $data['type'],
			'password' => bcrypt($data['password']),
		]);
	}
}