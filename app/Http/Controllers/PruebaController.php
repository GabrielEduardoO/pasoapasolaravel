<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Prueba;
use Illuminate\Http\Request;

class PruebaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
		public function getOrm()
		{
			$result = Prueba::first();
			dd($result);
		}
	
	public function index()
	{
		$result = \DB::table('users')
		->select(
			'users.*',
			'user_profiles.id as profile_id',
			'user_profiles.twitter',
			'user_profiles.birthdate'
			)
		->where('first_name','<>','Ricardo')
		->orderBy('first_name','ASC')
		//->orderBy(\DB::raw('RAND()')) //Funciones de SQL
		->join('user_profiles','users.id','=','user_profiles.user_id')
		//->leftJoin('user_profiles','users.id','=','user_profiles.user_id')
		//->first();
		->get();

		foreach ($result as $row)
		{
			$row->full_name = $row->first_name . ' ' . $row->last_name;
			$row->age = \Carbon\Carbon::parse($row->birthdate)->age;//sacar la edad
		}
		

		//$result->full_name = $result->first_name . ' ' . $result->last_name;

		//dd ($result->full_name);
		dd ($result);
		return $result;

 
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	

	public function create()
	{
		return view('pruebas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
