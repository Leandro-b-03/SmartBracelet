<?php 
	class Custumers extends \BaseController{
		
		public function index(){
			$custumers = Custumer::all();
			
			foreach ($custumers as $key => $custumer) {
				
				$custumers[$key]->birthday = date("d/m/Y", strtotime($custumers[$key]->birthday));
			
			}

			return View::make('custumers.index')
			->with('custumers', $custumers);
		}

		/**
	     * Show the form for creating a new resource.
	     *
	     * @return Response
	     */
		public function create()
	    {
	        return View::make('custumers.edit');
	    }

		/**
	     * Store a newly created resource in storage.
	     *
	     * @return Response
	     */
	    public function store()
	    {
	        // Inser the data on base.
	        try
	        {
	            DB::beginTransaction();
	            
	            $custumer = new Custumer;

	            $custumer->name         = Input::get('name');
	            $custumer->address         = Input::get('address');
	            $custumer->phone         = Input::get('phone');
	            $custumer->rg         = Input::get('rg');
	            $custumer->cpf         = Input::get('cpf');
	            $custumer->birthday         = date("Y-m-d", strtotime(Input::get('birthday')));
	           

	            $custumer->save();

	            DB::commit();

	            // redirect
	            return Redirect::to('custumers')->with('flash_notice', 'Cliente criado com sucesso!');
	        }
	        catch (Exception $e)
	        {
	            DB::rollback();
	            
	            return Redirect::route('custumers.create')->with('flash_error', 'Ocorreu um erro ao criar o cliente.')->withInput();
	        }
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
	        $data = array();

	        $custumer = Custumer::findOrFail($id);

	        $data['custumer'] = $custumer;

	        $data['custumer']->birthday = date("d/m/Y", strtotime($data['custumer']->birthday));

	        return View::make('custumers.edit')->with('data', $data);
	    }

	        /**
	     * Store a newly created resource in storage.
	     *
	     * @return Response
	     */
	    public function update($id)
	    {
	        // Inser the data on base.
	        try
	        {
	            DB::beginTransaction();
	            
	            $custumer = Custumer::findOrFail($id);

	            $custumer->name         = Input::get('name');
	            $custumer->address         = Input::get('address');
	            $custumer->phone         = Input::get('phone');
	            $custumer->rg         = Input::get('rg');
	            $custumer->cpf         = Input::get('cpf');
	            $custumer->birthday         = date("Y-m-d", strtotime(Input::get('birthday')));
	           

	            $custumer->save();

	            DB::commit();

	            // redirect
	            return Redirect::to('custumers')->with('flash_notice', 'Cliente atualizado com sucesso!');
	        }
	        catch (Exception $e)
	        {
	            DB::rollback();
	            
	            return Redirect::route('custumers.create')->with('flash_error', 'Ocorreu um erro ao atualizar o cliente.')->withInput();
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
	        try
	        {

	            DB::beginTransaction();
	            // delete
	            $custumer = Custumer::find($id);
	            $custumer->delete();

	            DB::commit();

	            // redirect
	            return Redirect::to('custumers')->with('flash_notice', 'Cliente deletado com sucesso!');
	        }
	        catch (Exception $e)
	        {
	            DB::rollback();
	            
	            return Redirect::to('custumers')->with('flash_error', 'Erro ao tentar deletar o cliente!');
	        }
	    }


	}
?>