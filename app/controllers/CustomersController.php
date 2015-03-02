<?php 
	class CustomersController extends \BaseController{
		
		public function index()
		{
			$customers = Customer::all();
			
			foreach ($customers as $key => $customer) {
				$customers[$key]->birthday = date("d/m/Y", strtotime($customers[$key]->birthday));
			}

			return View::make('customers.index')->with('customers', $customers);
		}

		/**
	     * Show the form for creating a new resource.
	     *
	     * @return Response
	     */
		public function create()
	    {
	        return View::make('customers.edit');
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
	            
	            $customer = new Customer;

	            $customer->name     = Input::get('name');
	            $customer->address  = Input::get('address');
	            $customer->phone    = Input::get('phone');
	            $customer->rg       = Input::get('rg');
	            $customer->cpf      = Input::get('cpf');
	            $customer->birthday = date("Y-m-d", strtotime(Input::get('birthday')));
	           

	            $customer->save();

	            DB::commit();

	            // redirect
	            return Redirect::to('customers')->with('flash_notice', 'Cliente criado com sucesso!');
	        }
	        catch (Exception $e)
	        {
	            DB::rollback();
	            
	            return Redirect::route('customers.create')->with('flash_error', 'Ocorreu um erro ao criar o cliente.')->withInput();
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

	        $customer = Customer::findOrFail($id);

	        $data['customer'] = $customer;

	        $data['customer']->birthday = date("d/m/Y", strtotime($data['customer']->birthday));

	        return View::make('customers.edit')->with('data', $data);
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
	            
	            $customer = Customer::findOrFail($id);

	            $customer->name         = Input::get('name');
	            $customer->address         = Input::get('address');
	            $customer->phone         = Input::get('phone');
	            $customer->rg         = Input::get('rg');
	            $customer->cpf         = Input::get('cpf');
	            $customer->birthday         = date("Y-m-d", strtotime(Input::get('birthday')));
	           

	            $customer->save();

	            DB::commit();

	            // redirect
	            return Redirect::to('customers')->with('flash_notice', 'Cliente atualizado com sucesso!');
	        }
	        catch (Exception $e)
	        {
	            DB::rollback();
	            
	            return Redirect::route('customers.create')->with('flash_error', 'Ocorreu um erro ao atualizar o cliente.')->withInput();
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
	            $customer = Customer::find($id);
	            $customer->delete();

	            DB::commit();

	            // redirect
	            return Redirect::to('customers')->with('flash_notice', 'Cliente deletado com sucesso!');
	        }
	        catch (Exception $e)
	        {
	            DB::rollback();
	            
	            return Redirect::to('customers')->with('flash_error', 'Erro ao tentar deletar o cliente!');
	        }
	    }


	}
?>