<?php

class SignUpController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$term = Term::where('status', 1)->get()->first();

		if(!Auth::user()->first_time) {
			return Redirect::to('myaccount');
		}

        return View::make('signup.index')->with('term', $term);
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
		try {
			$user = User::find(Auth::user()->id);

			$username = User::where('username', Input::get('username'))->get();

			if($username->count() == 1 && $username->first()->id == Auth::user()->id) {
				if(Input::get('password') == Input::get('confirm_password')) {
					if(Input::get('cnpj') == Auth::user()->cnpj) {
						$user->username 		= Input::get('username');

						if(Input::get('password') != "") {
							$user->password 	= Hash::make(Input::get('password'));
						}

						$user->first_time = 0;

						$user->save();

						$user_term = new UserTerm;

						$user_term->user_id = Auth::user()->id;
						$user_term->term_id = Term::where('status', 1)->get()->first();

						$user_term->save();
					} else {
						return Redirect::route('signup.index')->with('flash_error', 'CNPJ invalido.')->with('input', Input::all());
					}
				} else {
					return Redirect::route('signup.index')->with('flash_error', 'Senhas não coencidem.')->with('input', Input::all());
				}
			} else {
				return Redirect::route('signup.index')->with('flash_error', 'Nome de usuário já existe.')->with('input', Input::all());
			}

			// redirect
			return Redirect::to('home')->with('flash_notice', 'Usuário atualizado com sucesso!');
		} catch (Exception $e){
			return Redirect::route('signup.index')->with('flash_error', 'Ocorreu um erro.')->with('input', Input::all());

			debug($e->getMessage());
		}
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
