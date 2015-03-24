<?php

class GeneralController extends \BaseController {

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


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getComand()
	{
		$user_bracelet = UserBracelet::where('id_user', Input::get('id_user'))->where('status', -1)->get()->first();
		
		if ($user_bracelet) {
			if (!Input::get('new')) {
				$bracelet = Bracelet::where('tag', $user_bracelet->tag)->get()->first();

				$jsonSerialize = array();

				if ($bracelet) {
					$jsonSerialize['bracelet'] = $bracelet;

					$user_bracelet->status = 1;
					$user_bracelet->save();
				} else {
					$jsonSerialize['error'] = 'Comanda não cadastrada.';
				}

				return Response::json($jsonSerialize);
			} else {
				$jsonSerialize = array();

				$user_bracelet->status = 1;
				$user_bracelet->save();

				$jsonSerialize['bracelet'] = array('tag' => $user_bracelet->tag);

				return Response::json($jsonSerialize);
			}
		}
	}

}
