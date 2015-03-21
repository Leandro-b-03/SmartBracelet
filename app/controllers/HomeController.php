<?php

class HomeController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function index()
    {
        $data = array();

        $customers = Customer::all();

        $data['customers'] = array();

        foreach ($customers as $customer) {
            d($customer);
            d($customer->customer_bracelet()); die();
            if ($customer->customer_bracelet()->status != 1)
                $data['customers'][$customer->id] = $customer->name;
        }

        $bracelets = Bracelet::all();

        $data['bracelets'] = array();

        foreach ($bracelets as $bracelet) {
            if ($bracelet->customer_bracelet()->status != 1)
                $data['bracelets'][$bracelet->id] = $bracelet->tag . ' - ' . ($bracelet->color == 1 ? 'Vermelho' : 'Verde');
        }

        $data['order_bracelets'] = OrderBracelet::where('id_order', '0')->get();

        return View::make('home')->with('data', $data);
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
            
            $customer_bracelet = new CustomerBracelet;

            $customer_bracelet->id_customer   = Input::get('id_customer');
            $customer_bracelet->id_bracelet   = Input::get('id_bracelet');
            $customer_bracelet->status        = 1;

            $customer_bracelet->save();

            DB::commit();

            // redirect
            return Redirect::to('commands')->with('flash_notice', 'Pulseira criada com sucesso!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            
            return Redirect::route('commands.create')->with('flash_error', 'Ocorreu um erro ao criar a pulseira.')->withInput();
        }
    }

}
