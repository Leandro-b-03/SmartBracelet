<?php

class MyAccountController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('myaccount.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		try {
			$user = User::find($id);

			$user->corporate_name 	= Input::get('corporate_name');
			$user->name 			= Input::get('responsible');
			$user->cnpj 			= Input::get('cnpj');
			$user->email 			= Input::get('email');
			$user->telephone 		= Input::get('telephone');
			$user->mobile 			= Input::get('mobile');
			$user->address 			= Input::get('address');
			$user->url 				= Input::get('url');

			if(Input::get('password') != "") {
				$user->password 	= Hash::make(Input::get('password'));
			}

			$user->save();

			// redirect
			return Redirect::to('myaccount')->with('flash_notice', 'Usuário atualizado com sucesso!');
		} catch (Exception $e){
			return Redirect::route('myaccount')->with('flash_error', 'Ocorreu um erro.');
		}
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
