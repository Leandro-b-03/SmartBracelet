<?php

class GeneralController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function Company()
	{
		$cnpj_exisits = NewCompany::where('cnpj', Input::get('cnpj'))->get();

		if($cnpj_exisits->count() == 0) {
			if (Request::isMethod('post')) {
				$company = new NewCompany;

				$company->corporate_name = Input::get('corporate_name');
				$company->responsible = Input::get('responsible');
				$company->cnpj = Input::get('cnpj');
				$company->email = Input::get('email');
				$company->telephone = Input::get('telephone');
				$company->contact = Input::get('contact');

				$company->save();

				$data = array();

				// Need config e-mail host first
				Mail::send('emails.notify', $data, function($message) use ($company)
				{
				    $message->to($company->email, $company->responsible)->subject('Pré cadastro realizado com sucesso! Revender-me');
				});

				// Need config e-mail host first
				Mail::send('emails.notify', $data, function($message) use ($company)
				{
				    $message->to('leandro.b.03@gmail.com', $company->corporate_name)->subject('Loja se cadastrou no Revender-me');
				});

				return Redirect::route('login')->with('flash_notice', 'Você se pré cadastrou com sucesso, entraremos em contato.');
			} else {
				return Redirect::route('login')->with('flash_error', 'Ocorreu um erro ao tentar pré cadastradar a compania.')->withInput();
			}
		} else {
			return Redirect::to(URL::route('login') . '#signup')->with('flash_error', 'CNPJ já existente.')->withInput();;
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$credentials = array(
	        'app' => Input::get('app'),
	        'token' => Input::get('token')
	    );

	    $credentials = EApp::getCredentials($credentials)->get()->first();

	    if (isset($credentials->exists) && $credentials->exists)
	    {
	        Auth::loginUsingId($credentials->user_id);

	        if (null !== Auth::user())
	        {
	            $inputs = Input::get();

	            try
	            {
					DB::beginTransaction();

					$store_init = ConfigApp::where('type', 'general')->where('key', 'store_init')->get()->first();

		            $request = Request::create('store', 'POST', $inputs);
		            $response = Route::dispatch($request);

		            $store_init->value = $store_init->value + 1;
			        $store_init->save();

					DB::commit();
		            
		            if(Input::get('json'))
		                return json_encode($response->getContent());
		            else
		                return Redirect::away(Input::get('redirect'), 302, $headers = array('response' => $response->getContent()));
		        }
		        catch (Exception $e)
		        {
		        	DB::rollback();

				    if(Input::get('json'))
				        return json_encode(array('response' => 'Erro ao criar a loja, tente novamente mais tarde.'));
				    else
				        return Redirect::away(Input::get('redirect'), 302, $headers = array('response' => 'Erro ao criar a loja, tente novamente mais tarde.'));
		        }
	        }
	    }
	    if(Input::get('json'))
	        return json_encode(array('response' => 'Acesso negado pelo servidor.'));
	    else
	        return Redirect::away(Input::get('redirect'), 302, $headers = array('response' => 'Acesso negado pelo servidor.'));
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
